<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323233426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_settings (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, locale VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5C844C5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_position ADD amount INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD user_settings_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F08F511D FOREIGN KEY (user_settings_id) REFERENCES user_settings (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F08F511D ON user (user_settings_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F08F511D');
        $this->addSql('DROP TABLE user_settings');
        $this->addSql('ALTER TABLE order_position DROP amount');
        $this->addSql('DROP INDEX UNIQ_8D93D649F08F511D ON user');
        $this->addSql('ALTER TABLE user DROP user_settings_id');
    }
}
