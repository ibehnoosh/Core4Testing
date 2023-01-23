<?php
declare(strict_types = 1);
namespace App\Entity\ShoppingCart;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'shopping_cart_item')]
class Item
{

    #[Column(type: Types::INTEGER)]
    private $id;

    #[Column(name : 'id_shopping_cart_line' ,type: Types::INTEGER)]
    private int $ShoppingCartLineId;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[Column(type: Types::INTEGER)]
    private $quantity;
}