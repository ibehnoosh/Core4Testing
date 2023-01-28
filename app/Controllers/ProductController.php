<?php

namespace App\Controllers;

use App\Entity\Category;
use App\Services\CategoryService;
use App\Services\productService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ProductController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly ProductService $productService,
        private readonly CategoryService $categoryService,
    )
    {
    }

    public function index(Request $request, Response $response): Response
    {

        return $this->twig->render(
            $response,
            'product/index.twig',
            [
                'products' => $this->productService->getAll(),
                'categories' => $this->categoryService->getAll(),
            ]
        );
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        var_dump($data);
        $this->productService->create($data);

        return $response->withHeader('Location', '/product')->withStatus(302);
    }

    public function get(Request $request, Response $response, array $params): Response
    {
        $category=$this->productService->getById((int) $params['id']);
        if (! $category) {
            return $response->withStatus(404);
        }

        $data = ['id' => $category->getId(), 'name' => $category->getName()];

        return $this->twig->render(
            $response,
            'product/index.twig',
            [
                'categories' => $this->productService->getAll(),
                'edit' => $data
            ]
        );
    }

    public function update(Request $request, Response $response, array $params): Response
    {
        $data = $params + $request->getParsedBody();
        $category = $this->productService->getById((int) $data['id']);
        if (! $category) {
            return $response->withStatus(404);
        }
        $this->productService->update($category, $data['name']);
        return $response->withHeader('Location', '/product')->withStatus(302);
    }

    public function delete(Request $request, Response $response, array $params): Response
    {
        $this->productService->delete((int) $params['id']);
        return $response->withHeader('Location', '/product')->withStatus(302);
    }
}