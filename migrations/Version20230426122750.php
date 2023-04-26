<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426122750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE todo_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE todo_list_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE todo_list (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE todo_list_item (id INT NOT NULL, list_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17404CE73DAE168B ON todo_list_item (list_id)');
        $this->addSql('ALTER TABLE todo_list_item ADD CONSTRAINT FK_17404CE73DAE168B FOREIGN KEY (list_id) REFERENCES todo_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE todo_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE todo_list_item_id_seq CASCADE');
        $this->addSql('ALTER TABLE todo_list_item DROP CONSTRAINT FK_17404CE73DAE168B');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('DROP TABLE todo_list_item');
    }
}
