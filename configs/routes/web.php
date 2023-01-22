<?php

declare(strict_types = 1);

use App\Controller\BasketController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);

    $app->group('/product', function (RouteCollectorProxy $categories) {
        $categories->get('', [ProductController::class, 'index']);
        $categories->post('', [ProductController::class, 'store']);
        $categories->delete('/{id:[0-9]+}', [ProductController::class, 'delete']);
        $categories->get('/{id:[0-9]+}', [ProductController::class, 'get']);
        $categories->post('/{id:[0-9]+}', [ProductController::class, 'update']);
    });
    $app->group('/basket', function (RouteCollectorProxy $categories) {
        $categories->get('/{id:[0-9]+}', [BasketController::class, 'index']);
    });
};
