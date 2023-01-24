<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124112353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_categories (product_id VARCHAR(255) NOT NULL, category_id VARCHAR(255) NOT NULL, INDEX IDX_E8ACBE764584665A (product_id), INDEX IDX_E8ACBE7612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_cart (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_cart_item (id VARCHAR(255) NOT NULL, line_id VARCHAR(255) DEFAULT NULL, product_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, quantity INT NOT NULL, INDEX IDX_E59A1DF44D7B7542 (line_id), INDEX IDX_E59A1DF44584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_cart_line (id VARCHAR(255) NOT NULL, shopping_cart_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2B958C1C45F80CD (shopping_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products_categories ADD CONSTRAINT FK_E8ACBE764584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_categories ADD CONSTRAINT FK_E8ACBE7612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_cart_item ADD CONSTRAINT FK_E59A1DF44D7B7542 FOREIGN KEY (line_id) REFERENCES shopping_cart_line (id)');
        $this->addSql('ALTER TABLE shopping_cart_item ADD CONSTRAINT FK_E59A1DF44584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE shopping_cart_line ADD CONSTRAINT FK_2B958C1C45F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_categories DROP FOREIGN KEY FK_E8ACBE764584665A');
        $this->addSql('ALTER TABLE products_categories DROP FOREIGN KEY FK_E8ACBE7612469DE2');
        $this->addSql('ALTER TABLE shopping_cart_item DROP FOREIGN KEY FK_E59A1DF44D7B7542');
        $this->addSql('ALTER TABLE shopping_cart_item DROP FOREIGN KEY FK_E59A1DF44584665A');
        $this->addSql('ALTER TABLE shopping_cart_line DROP FOREIGN KEY FK_2B958C1C45F80CD');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE products_categories');
        $this->addSql('DROP TABLE shopping_cart');
        $this->addSql('DROP TABLE shopping_cart_item');
        $this->addSql('DROP TABLE shopping_cart_line');
    }
}
