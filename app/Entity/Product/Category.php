<?php
declare(strict_types = 1);
namespace App\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;

#[Entity]
#[Table(name: 'category')]
class Category
{
    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private $id;

    #[Column(type: Types::STRING)]
    private $name;


    #[ManyToMany(targetEntity: Product::class, mappedBy: 'categories')]
    private Collection $products;

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    public function addProduct(Product $product):void
    {
        $this->products[] = $product;
    }

    public function getProducts(): ArrayCollection|Collection
    {
        return $this->products;
    }

}