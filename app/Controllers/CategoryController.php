<?php

namespace App\Controllers;

use App\Services\CategoryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CategoryController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly CategoryService $categoryService,
    )
    {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render(
            $response,
            'categories/index.twig',
            [
                'categories' => $this->categoryService->getAll(),
            ]
        );
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $this->categoryService->create($data['name']);

        return $response->withHeader('Location', '/category')->withStatus(302);
    }

    public function get(Request $request, Response $response, array $params): Response
    {
        $category=$this->categoryService->getById((int) $params['id']);
        if (! $category) {
            return $response->withStatus(404);
        }

        $data = ['id' => $category->getId(), 'name' => $category->getName()];

        return $this->twig->render(
            $response,
            'categories/index.twig',
            [
                'categories' => $this->categoryService->getAll(),
                'edit' => $data
            ]
        );
    }

    public function update(Request $request, Response $response, array $params): Response
    {
        $data = $params + $request->getParsedBody();
        $category = $this->categoryService->getById((int) $data['id']);
        if (! $category) {
            return $response->withStatus(404);
        }
        $this->categoryService->update($category, $data['name']);
        return $response->withHeader('Location', '/category')->withStatus(302);
    }

    public function delete(Request $request, Response $response, array $params): Response
    {
        $this->categoryService->delete((int) $params['id']);
        return $response;
    }
}