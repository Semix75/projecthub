<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320125521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, projet_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_4B98C21C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B98C216C6E55B5 ON groupe (nom)');
        $this->addSql('CREATE INDEX IDX_4B98C21C18272 ON groupe (projet_id)');
        $this->addSql('CREATE TABLE groupe_users (groupe_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(groupe_id, user_id), CONSTRAINT FK_412E6BB97A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_412E6BB9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_412E6BB97A45358C ON groupe_users (groupe_id)');
        $this->addSql('CREATE INDEX IDX_412E6BB9A76ED395 ON groupe_users (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_users');
    }
}
