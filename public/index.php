<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Services\ImageService;

require 'vendor/autoload.php';

$container = new \Slim\Container();

$container['imageService'] = function ($container) {
    $imageService = new ImageService();
    return $imageService;
};

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $container['response']
            ->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->write(
                json_encode(["error" => ["message" => "Something went wrong", "code!" => 500]])
            );
    };
};

$app = new \Slim\App($container);

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


     return $response->withJson($tagArray, 200);

 });

$app->run();


