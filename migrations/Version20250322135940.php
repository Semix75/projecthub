<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250322135940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribution (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, projet_id INTEGER DEFAULT NULL, CONSTRAINT FK_C751ED49A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C751ED49C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C751ED49A76ED395 ON attribution (user_id)');
        $this->addSql('CREATE INDEX IDX_C751ED49C18272 ON attribution (projet_id)');
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_8A8E26E9B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8A8E26E9B03A8386 ON conversation (created_by_id)');
        $this->addSql('CREATE TABLE conversation_user (conversation_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(conversation_id, user_id), CONSTRAINT FK_5AECB5559AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5AECB555A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5AECB5559AC0396 ON conversation_user (conversation_id)');
        $this->addSql('CREATE INDEX IDX_5AECB555A76ED395 ON conversation_user (user_id)');
        $this->addSql('CREATE TABLE friendship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, requester_id INTEGER DEFAULT NULL, receiver_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, blocked_by INTEGER DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, friend_at DATETIME DEFAULT NULL, CONSTRAINT FK_7234A45FED442CF4 FOREIGN KEY (requester_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7234A45FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7234A45FED442CF4 ON friendship (requester_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FCD53EDB6 ON friendship (receiver_id)');
        $this->addSql('CREATE TABLE groupe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, projet_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_4B98C21C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B98C216C6E55B5 ON groupe (nom)');
        $this->addSql('CREATE INDEX IDX_4B98C21C18272 ON groupe (projet_id)');
        $this->addSql('CREATE TABLE groupe_users (groupe_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(groupe_id, user_id), CONSTRAINT FK_412E6BB97A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_412E6BB9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_412E6BB97A45358C ON groupe_users (groupe_id)');
        $this->addSql('CREATE INDEX IDX_412E6BB9A76ED395 ON groupe_users (user_id)');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, send_by_id INTEGER NOT NULL, conversation_id INTEGER DEFAULT NULL, content CLOB DEFAULT NULL, send_at DATETIME DEFAULT NULL, is_read BOOLEAN DEFAULT NULL, read_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_B6BD307FC3852542 FOREIGN KEY (send_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B6BD307FC3852542 ON message (send_by_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)');
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, nb_place_min INTEGER DEFAULT NULL, nb_place_max INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, last_online DATETIME DEFAULT NULL, biographie CLOB DEFAULT NULL, username VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE voeux (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, projet_id INTEGER NOT NULL, priorite INTEGER DEFAULT NULL, CONSTRAINT FK_917F7851A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_917F7851C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_917F7851A76ED395 ON voeux (user_id)');
        $this->addSql('CREATE INDEX IDX_917F7851C18272 ON voeux (projet_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attribution');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE conversation_user');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_users');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE voeux');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
