<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327152550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_price (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, price NUMERIC(2, 0) NOT NULL, country_code VARCHAR(3) NOT NULL, INDEX IDX_BD7F50C87294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_2EEA2F082C2AC5D3 (translatable_id), UNIQUE INDEX article_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BA388B79395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doiconfirmation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, confirmation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', send DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_7F561C5DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forget_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', approved DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E0B7C9B5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_position (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, order_id INT DEFAULT NULL, current_article_price NUMERIC(10, 2) NOT NULL, amount INT NOT NULL, INDEX IDX_A7D406447294869C (article_id), INDEX IDX_A7D406448D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, order_created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E52FFDEE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage_article (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, storage_id INT DEFAULT NULL, amount INT NOT NULL, INDEX IDX_75063D047294869C (article_id), INDEX IDX_75063D045CC5DB90 (storage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_settings_id INT DEFAULT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(10000) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', address_street VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F08F511D (user_settings_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_settings (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, locale VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5C844C5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_price ADD CONSTRAINT FK_BD7F50C87294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE doiconfirmation ADD CONSTRAINT FK_7F561C5DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forget_password_request ADD CONSTRAINT FK_E0B7C9B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_position ADD CONSTRAINT FK_A7D406447294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE order_position ADD CONSTRAINT FK_A7D406448D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE storage_article ADD CONSTRAINT FK_75063D047294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage_article ADD CONSTRAINT FK_75063D045CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F08F511D FOREIGN KEY (user_settings_id) REFERENCES user_settings (id)');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_price DROP FOREIGN KEY FK_BD7F50C87294869C');
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F082C2AC5D3');
        $this->addSql('ALTER TABLE order_position DROP FOREIGN KEY FK_A7D406447294869C');
        $this->addSql('ALTER TABLE storage_article DROP FOREIGN KEY FK_75063D047294869C');
        $this->addSql('ALTER TABLE order_position DROP FOREIGN KEY FK_A7D406448D9F6D38');
        $this->addSql('ALTER TABLE storage_article DROP FOREIGN KEY FK_75063D045CC5DB90');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE doiconfirmation DROP FOREIGN KEY FK_7F561C5DA76ED395');
        $this->addSql('ALTER TABLE forget_password_request DROP FOREIGN KEY FK_E0B7C9B5A76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C5A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F08F511D');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_price');
        $this->addSql('DROP TABLE article_translation');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE doiconfirmation');
        $this->addSql('DROP TABLE forget_password_request');
        $this->addSql('DROP TABLE order_position');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE storage');
        $this->addSql('DROP TABLE storage_article');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_settings');
    }
}
