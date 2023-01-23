<?php
declare(strict_types = 1);
namespace App\Entity\Product;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use mysql_xdevapi\Collection;

#[Entity]
#[Table(name: 'product_category')]
class Product
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

    #[Column(type: Types::DECIMAL)]
    private $price;

    #[Column(type: Types::INTEGER)]
    private $quantity;

    private Collection $category;

    public function addCategory(Category $category):void
    {
        $category->addCategory($this); // synchronously updating inverse side
        $this->$category[] = $category;
    }


}