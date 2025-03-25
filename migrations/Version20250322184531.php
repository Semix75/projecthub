<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250322184531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation_user (conversation_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(conversation_id, user_id), CONSTRAINT FK_5AECB5559AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5AECB555A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5AECB5559AC0396 ON conversation_user (conversation_id)');
        $this->addSql('CREATE INDEX IDX_5AECB555A76ED395 ON conversation_user (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__conversation AS SELECT id FROM conversation');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_8A8E26E9B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO conversation (id) SELECT id FROM __temp__conversation');
        $this->addSql('DROP TABLE __temp__conversation');
        $this->addSql('CREATE INDEX IDX_8A8E26E9B03A8386 ON conversation (created_by_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__message AS SELECT id, send_by_id, conversation_id, content, send_at, is_read, read_at FROM message');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, send_by_id INTEGER DEFAULT NULL, conversation_id INTEGER DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, send_at VARCHAR(255) DEFAULT NULL, is_read BOOLEAN DEFAULT NULL, read_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_B6BD307FC3852542 FOREIGN KEY (send_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO message (id, send_by_id, conversation_id, content, send_at, is_read, read_at) SELECT id, send_by_id, conversation_id, content, send_at, is_read, read_at FROM __temp__message');
        $this->addSql('DROP TABLE __temp__message');
        $this->addSql('CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FC3852542 ON message (send_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conversation_user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__conversation AS SELECT id FROM conversation');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO conversation (id) SELECT id FROM __temp__conversation');
        $this->addSql('DROP TABLE __temp__conversation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__message AS SELECT id, send_by_id, conversation_id, content, send_at, is_read, read_at FROM message');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, send_by_id INTEGER DEFAULT NULL, conversation_id INTEGER DEFAULT NULL, content CLOB DEFAULT NULL, send_at DATETIME DEFAULT NULL, is_read BOOLEAN DEFAULT NULL, read_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_B6BD307FC3852542 FOREIGN KEY (send_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO message (id, send_by_id, conversation_id, content, send_at, is_read, read_at) SELECT id, send_by_id, conversation_id, content, send_at, is_read, read_at FROM __temp__message');
        $this->addSql('DROP TABLE __temp__message');
        $this->addSql('CREATE INDEX IDX_B6BD307FC3852542 ON message (send_by_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)');
    }
}
