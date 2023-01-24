<?php
declare(strict_types = 1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'shopping_cart_line')]
class Line
{
    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private $id;

    #[Column]
    private string $name;

    #[ManyToOne(targetEntity: ShoppingCart::class, inversedBy: 'shopping_cart_line')]
    #[JoinColumn(name: 'shopping_cart_id', referencedColumnName: 'id')]
    private ShoppingCart|null $shoppingCart = null;

    #[OneToMany(targetEntity: Item::class, mappedBy: 'shopping_cart_line')]
    private Collection $items;


    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
}