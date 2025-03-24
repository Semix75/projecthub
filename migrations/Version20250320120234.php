<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320120234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friendship ADD COLUMN blocked_by INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__friendship AS SELECT id, requester_id, receiver_id, status, created_at, updated_at, friend_at FROM friendship');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('CREATE TABLE friendship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, requester_id INTEGER DEFAULT NULL, receiver_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, friend_at DATETIME DEFAULT NULL, CONSTRAINT FK_7234A45FED442CF4 FOREIGN KEY (requester_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7234A45FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO friendship (id, requester_id, receiver_id, status, created_at, updated_at, friend_at) SELECT id, requester_id, receiver_id, status, created_at, updated_at, friend_at FROM __temp__friendship');
        $this->addSql('DROP TABLE __temp__friendship');
        $this->addSql('CREATE INDEX IDX_7234A45FED442CF4 ON friendship (requester_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FCD53EDB6 ON friendship (receiver_id)');
    }
}
