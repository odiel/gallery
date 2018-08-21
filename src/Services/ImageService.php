<?php

namespace Services;

class ImageService {

    private $dbFile = "";

    function __construct($dbFile)
    {
        if (!is_file($dbFile)) {
            throw new \Exception("File ${dbFile} does not exist and it is required.");
        }

        $this->dbFile = $dbFile;
    }

    public function searchByTags(int $limit, array $tags): array {
        $content = file_get_contents($this->dbFile);

        //todo: log the failure of the file load
        if ($content === false)
            return [];

        $jsonContent = json_decode($content);

        //todo: inspect json_last_error code and log the error
        if ($jsonContent === null)
            return [];

        $jsonContentLength = count($jsonContent);

        $recordsFound = 0;

        $result = [
            "totalNumberOfRecords" => $jsonContentLength,
            "recordsFound" => $recordsFound,
            "records" => []
        ];

        $tagsLength = count($tags);

        for ($i = 0; $i < $jsonContentLength; $i++) {
            $record = $jsonContent[$i];

            for ($j = 0; $j < $tagsLength; $j++) {
                $tag = trim($tags[$j]);
                if (in_array($tag, $record->tags)) {
                    $result["records"][] = ["width" => $record->width, "height" => $record->height, "url" => $record->url];
                    $recordsFound++;
                    break;
                }
            }

            if ($recordsFound >= $limit) break;
        }

        $result["recordsFound"] = $recordsFound;

        return $result;
    }

}


