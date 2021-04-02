<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331205510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_position ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_position ADD CONSTRAINT FK_A7D406441AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_A7D406441AD5CDBF ON order_position (cart_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_position DROP FOREIGN KEY FK_A7D406441AD5CDBF');
        $this->addSql('DROP INDEX IDX_A7D406441AD5CDBF ON order_position');
        $this->addSql('ALTER TABLE order_position DROP cart_id');
    }
}
