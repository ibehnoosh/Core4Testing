<?php
declare(strict_types = 1);
namespace App\Entity\ShoppingCart;

use App\Entity\Product\Product;
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
    #[Id, Column(options: ['unsigned' => true]), GeneratedValue]
    private $id;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[Column(type: Types::INTEGER)]
    private $quantity;

    #[ManyToOne(targetEntity: Line::class)]
    #[JoinColumn(name: 'line_id', referencedColumnName: 'id')]
    private Line|int $shoppingCartLine;


    #[ManyToOne(targetEntity: Product::class)]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product|int $shoppingCartProducts;

}