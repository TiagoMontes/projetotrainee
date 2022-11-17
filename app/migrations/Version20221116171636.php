<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116171636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critica (id INT AUTO_INCREMENT NOT NULL, critica VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diretor (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filme (id INT AUTO_INCREMENT NOT NULL, diretor_id INT NOT NULL, genero_id INT NOT NULL, texto_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_3A387F002F5AD552 (diretor_id), INDEX IDX_3A387F00BCE7B795 (genero_id), INDEX IDX_3A387F0085D01195 (texto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F002F5AD552 FOREIGN KEY (diretor_id) REFERENCES diretor (id)');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F00BCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F0085D01195 FOREIGN KEY (texto_id) REFERENCES critica (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F002F5AD552');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F00BCE7B795');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F0085D01195');
        $this->addSql('DROP TABLE critica');
        $this->addSql('DROP TABLE diretor');
        $this->addSql('DROP TABLE filme');
        $this->addSql('DROP TABLE genero');
    }
}
