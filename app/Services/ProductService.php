<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\Entities;
use App\Contracts\Services;
use App\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductService implements Services
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function create($name): Product
    {
        $product = new Product();
        return $this->update($product, $name);
    }

    public function getAll() : array
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }

    public function delete(int $id): void
    {
        $product = $this->entityManager->find(Product::class, $id);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    public function getById(int $id): ?Product
    {
        return $this->entityManager->find(Product::class, $id);
    }

    public function update(Entities $product, $name): Product
    {
        $product->setName($name);
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product;
    }

}
