<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116145128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critica (id INT AUTO_INCREMENT NOT NULL, critica VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filme ADD texto_id INT NOT NULL');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F0085D01195 FOREIGN KEY (texto_id) REFERENCES critica (id)');
        $this->addSql('CREATE INDEX IDX_3A387F0085D01195 ON filme (texto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F0085D01195');
        $this->addSql('DROP TABLE critica');
        $this->addSql('DROP INDEX IDX_3A387F0085D01195 ON filme');
        $this->addSql('ALTER TABLE filme DROP texto_id');
    }
}