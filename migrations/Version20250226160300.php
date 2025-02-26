<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226160300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, nb_place INTEGER DEFAULT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE voeux (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, projet_id INTEGER NOT NULL, CONSTRAINT FK_917F7851A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_917F7851C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_917F7851A76ED395 ON voeux (user_id)');
        $this->addSql('CREATE INDEX IDX_917F7851C18272 ON voeux (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE voeux');
    }
}
