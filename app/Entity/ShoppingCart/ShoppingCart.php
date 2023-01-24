<?php
declare(strict_types = 1);
namespace App\Entity\ShoppingCart;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'shopping_cart')]
#[HasLifecycleCallbacks]
class ShoppingCart
{
    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private $id;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    /**
     * One shoppingCart has many lines. This is the inverse side.
     */
    #[OneToMany(targetEntity: Line::class, mappedBy: 'shopping_cart')]
    private Collection $lines;


    public function __construct()
    {
        $this->lines = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

}