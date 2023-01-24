<?php
declare(strict_types = 1);
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'shopping_cart_item')]
class Item
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private $id;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[Column(type: Types::INTEGER)]
    private $quantity;

    #[ManyToOne(targetEntity: Line::class,inversedBy: 'shopping_cart_item')]
    #[JoinColumn(name: 'line_id', referencedColumnName: 'id')]
    private Line|int $shoppingCartLine;


    #[ManyToOne(targetEntity: Product::class,inversedBy: 'shopping_cart_item')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product|int $shoppingCartProducts;

}