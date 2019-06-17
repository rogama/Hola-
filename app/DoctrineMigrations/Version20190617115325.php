<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190617115325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE groups (group_id INT AUTO_INCREMENT NOT NULL, group_title VARCHAR(100) NOT NULL, PRIMARY KEY(group_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD group_id INT DEFAULT NULL, DROP roles');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FE54D947 FOREIGN KEY (group_id) REFERENCES groups (group_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FE54D947 ON user (group_id)');

        $this->addSql('INSERT INTO groups (group_title) VALUES  ("ADMIN")');
        $this->addSql('INSERT INTO groups (group_title) VALUES  ("PAGE_1")');
        $this->addSql('INSERT INTO groups (group_title) VALUES  ("PAGE_2")');

        $this->addSql('INSERT INTO user (name, username, password, roles) VALUES  ("Admin", "admin", "adminpassword", "1")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FE54D947');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP INDEX IDX_8D93D649FE54D947 ON user');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', DROP group_id');
    }
}
