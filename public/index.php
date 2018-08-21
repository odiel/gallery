<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/images/{number}/{tags}', function (Request $request, Response $response, array $args) {
    $number = $args['number'];
    $tags = $args['tags'];

    $response->getBody()->write("Number: ${number} Tags: ${tags}");

    return $response;
});
$app->run();

