<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401224110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_price DROP FOREIGN KEY FK_BD7F50C87294869C');
        $this->addSql('ALTER TABLE article_price CHANGE article_id article_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_price ADD CONSTRAINT FK_BD7F50C87294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_price DROP FOREIGN KEY FK_BD7F50C87294869C');
        $this->addSql('ALTER TABLE article_price CHANGE article_id article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_price ADD CONSTRAINT FK_BD7F50C87294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }
}
