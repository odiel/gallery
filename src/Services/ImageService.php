<?php

namespace Services;

class ImageService {

    private $dbFile = "";

    function __construct($dbFile)
    {
        if (!is_file($dbFile)) {
            throw new \Exception("File ${$dbFile} does not exist and it is required.");
        }

        $this->dbFile = $dbFile;
    }

    public function searchByTags(int $limit, array $tags): array {
        


        return [];
    }

}


