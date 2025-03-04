<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227092401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, nb_place INTEGER DEFAULT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE voeux (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, projet_id INTEGER NOT NULL, CONSTRAINT FK_917F7851A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_917F7851C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
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
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE voeux');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
