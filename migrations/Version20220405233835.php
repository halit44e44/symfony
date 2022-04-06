<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405233835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, order_code VARCHAR(255) NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, address LONGTEXT NOT NULL, shipping_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //INSERT INTO `user`(`email`, `roles`, `password`) VALUES ('admin@admin.com','["USER_ADMIN"]','$2y$13$fuAjNNcZXnbq5Vq8ToMoE.U9o.daAbn6hy8JBtEA.SXtikvoUlJFO')
//      $this->addSql('INSERT INTO user (email,roles,password) VALUES ("admin@admin.com", "[\"USER_ADMIN\"]", "$2y$13$fuAjNNcZXnbq5Vq8ToMoE.U9o.daAbn6hy8JBtEA.SXtikvoUlJFO")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE user');
    }
}
