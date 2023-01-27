<?php

namespace Services;

use App\Entity\Category;
use App\Services\CategoryService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    private $categoryService;
    private $mockEntityManager;

    public function setUp(): void
    {
        $this->mockEntityManager = $this->createMock(EntityManager::class);
        $this->categoryService = new CategoryService($this->mockEntityManager);
    }

    public function testCreate(): void
    {
        $name = "test category";
        $category = new Category();
        $category->setName($name);

        $this->mockEntityManager->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($category));

        $this->mockEntityManager->expects($this->once())
            ->method('flush');

        $result = $this->categoryService->create($name);
        $this->assertEquals($category, $result);
    }

    public function testGetAll()
    {
        $categories = [new Category(), new Category()];
        $this->mockEntityManager->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(Category::class))
            ->willReturn($categories);

        $result = $this->categoryService->getAll();
        $this->assertEquals($categories, $result);
    }

    public function testDelete(): void
    {
        $id = 1;
        $category = new Category();
        $this->mockEntityManager->expects($this->once())
            ->method('find')
            ->with($this->equalTo(Category::class), $this->equalTo($id))
            ->willReturn($category);

        $this->mockEntityManager->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($category));

        $this->mockEntityManager->expects($this->once())
            ->method('flush');

        $this->categoryService->delete($id);
    }

    public function testGetById(): void
    {
        $id = 1;
        $category = new Category();
        $this->mockEntityManager->expects($this->once())
            ->method('find')
            ->with($this->equalTo(Category::class), $this->equalTo($id))
            ->willReturn($category);

        $result = $this->categoryService->getById($id);
        $this->assertEquals($category, $result);
    }

    public function testUpdate(): void
    {
        $name = "test category";
        $category = new Category();
        $category->setName($name);

        $this->mockEntityManager->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($category));

        $this->mockEntityManager->expects($this->once())
            ->method('flush');

        $result = $this->categoryService->update($category, $name);
        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($name, $result->getName());
    }

}

