<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\Entities;
use App\Contracts\Services;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductService implements Services
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function create($data): Product
    {
        $product = new Product();
        return $this->update($product, $data);
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

    public function update(Entities $product, $data): Product
    {

        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setQuantity($data['quantity']);
        $product->setCreatedAt();
        $product->setUpdatedAt();
        foreach ($data['categories'] as $category)
        {
            var_dump($category);
            $product->addCategories($category);
        }


        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product;
    }

}
