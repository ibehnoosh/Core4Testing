<?php
declare(strict_types = 1);
namespace App\Entity;

use App\Contracts\Entities;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'product')]
#[HasLifecycleCallbacks]
class Product implements Entities
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private $id;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[Column(type: Types::STRING)]
    private $name;

    #[Column(type: Types::DECIMAL, precision: 13,scale: 3)]
    private $price;

    #[Column(type: Types::INTEGER)]
    private $quantity;

    #[ManyToMany(targetEntity: Category::class, inversedBy: 'products')]
    #[JoinTable(name: 'products_categories')]
    private Collection $categories;

    #[OneToMany(targetEntity: Item::class, mappedBy: 'products')]
    private Collection $items;


    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;

    }

    public function setCreatedAt()
    {
        $this->createdAt =new \DateTime("now");
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime("now");
    }
    //Owning Side of Product Category
    public function addCategories(Category $category):void
    {
        $category->addProduct($this); // synchronously updating inverse side
        $this->categories[] = $category;
    }

    public function getCategories(): ArrayCollection|Collection
    {
        return $this->categories;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
}