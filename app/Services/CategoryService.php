<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\Entities;
use App\Contracts\Services;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;

class CategoryService implements Services
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function create($name): Category
    {
        $category = new Category();
        return $this->update($category, $name);
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    public function delete(int $id): void
    {
        $category = $this->entityManager->find(Category::class, $id);
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

    public function getById(int $id): ?Category
    {
        return $this->entityManager->find(Category::class, $id);
    }

    public function update(Entities $category, $name): Category
    {
        $category->setName($name);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }

}
