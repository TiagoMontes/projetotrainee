<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122152536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critica DROP FOREIGN KEY FK_22C49E3EE6E418AD');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, diretor_id INT NOT NULL, genero_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1D5EF26F2F5AD552 (diretor_id), INDEX IDX_1D5EF26FBCE7B795 (genero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F2F5AD552 FOREIGN KEY (diretor_id) REFERENCES diretor (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F002F5AD552');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F00BCE7B795');
        $this->addSql('DROP TABLE filme');
        $this->addSql('DROP INDEX IDX_22C49E3EE6E418AD ON critica');
        $this->addSql('ALTER TABLE critica CHANGE filme_id movie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critica ADD CONSTRAINT FK_22C49E3E8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_22C49E3E8F93B6FC ON critica (movie_id)');
        $this->addSql('ALTER TABLE diretor CHANGE nome name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critica DROP FOREIGN KEY FK_22C49E3E8F93B6FC');
        $this->addSql('CREATE TABLE filme (id INT AUTO_INCREMENT NOT NULL, diretor_id INT NOT NULL, genero_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3A387F002F5AD552 (diretor_id), INDEX IDX_3A387F00BCE7B795 (genero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F002F5AD552 FOREIGN KEY (diretor_id) REFERENCES diretor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F00BCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F2F5AD552');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FBCE7B795');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP INDEX IDX_22C49E3E8F93B6FC ON critica');
        $this->addSql('ALTER TABLE critica CHANGE movie_id filme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critica ADD CONSTRAINT FK_22C49E3EE6E418AD FOREIGN KEY (filme_id) REFERENCES filme (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_22C49E3EE6E418AD ON critica (filme_id)');
        $this->addSql('ALTER TABLE diretor CHANGE name nome VARCHAR(255) NOT NULL');
    }
}
