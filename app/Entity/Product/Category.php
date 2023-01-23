<?php
declare(strict_types = 1);
namespace App\Entity\Product;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use mysql_xdevapi\Collection;

#[Entity]
#[Table(name: 'product_category')]
class Category
{
    #[Column(type: Types::INTEGER)]
    private $id;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[Column(type: Types::STRING)]
    private $name;

    #[Column(type: Types::STRING)]
    private $description;

    private Collection $product;

    public function addCategory(Product $product):void
    {
        $this->product[] = $product;
    }
}