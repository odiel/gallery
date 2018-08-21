<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Services\ImageService;

require 'vendor/autoload.php';

// Dependency Container definition
$container = new \Slim\Container();

// Defining the Image Service service to be used latter
$container['imageService'] = function ($container) {
    $imageService = new ImageService(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . "file.json");
    return $imageService;
};

// Defining an error/exception handler to return a custom response
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        //todo: log the exception somewhere to build up a report later

        $code = 500;
        return $container['response']
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->write(
                json_encode(["error" => ["message" => "Something went wrong", "code" => $code]])
            );
    };
};

// Defining a not found error handler to return a custom response
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        //todo: log the not found entry somewhere to build up a report later and see what other urls the users are trying out

        $code = 404;
        return $container['response']
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(["error" => ["message" => "Page not found", "code" => $code]]));
    };
};

// Assign the container to the application
$app = new \Slim\App($container);

// Define our API end point and handler.
$app->get('/images/{number}/{tags}', function (Request $request, Response $response, array $args) {
     $number = (int) ($args['number']);

     if ($number == 0) {
         $number = 10;
     }

     $tags = $args['tags'];
     $tagArray = [];

     if (strlen($tags) > 0) {
         $tagArray =  explode(',', $tags);
     }


     $imageService = $this->get('imageService');
     $searchResult = $imageService->searchByTags($number, $tagArray);

     return $response->withJson($searchResult, 200);
});

$app->run();


