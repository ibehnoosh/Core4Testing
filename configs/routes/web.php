<?php

declare(strict_types = 1);

use App\Controllers\HomeController;
use App\Controllers\CategoryController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);

    $app->group('/category', function (RouteCollectorProxy $categories) {
        $categories->get('', [CategoryController::class, 'index']);
        $categories->post('', [CategoryController::class, 'store']);
        $categories->delete('/{id:[0-9]+}', [CategoryController::class, 'delete']);
        $categories->get('/{id:[0-9]+}', [CategoryController::class, 'get']);
        $categories->post('/{id:[0-9]+}', [CategoryController::class, 'update']);
    });
};
