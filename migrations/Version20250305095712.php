<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250305095712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE conversation_participants');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projet AS SELECT id, intitule, description, nb_place FROM projet');
        $this->addSql('DROP TABLE projet');
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, nb_place_min INTEGER DEFAULT NULL, nb_place_max INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO projet (id, intitule, description, nb_place_min) SELECT id, intitule, description, nb_place FROM __temp__projet');
        $this->addSql('DROP TABLE __temp__projet');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, projet_id INTEGER NOT NULL, CONSTRAINT FK_8A8E26E9C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A8E26E9C18272 ON conversation (projet_id)');
        $this->addSql('CREATE TABLE conversation_participants (conversation_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(conversation_id, user_id), CONSTRAINT FK_21821ED39AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_21821ED3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_21821ED3A76ED395 ON conversation_participants (user_id)');
        $this->addSql('CREATE INDEX IDX_21821ED39AC0396 ON conversation_participants (conversation_id)');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, conversation_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE "BINARY", created_at DATETIME NOT NULL, CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projet AS SELECT id, intitule, description FROM projet');
        $this->addSql('DROP TABLE projet');
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, nb_place INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO projet (id, intitule, description) SELECT id, intitule, description FROM __temp__projet');
        $this->addSql('DROP TABLE __temp__projet');
    }
}
