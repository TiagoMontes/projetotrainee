<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116211711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critica ADD filme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critica ADD CONSTRAINT FK_22C49E3EE6E418AD FOREIGN KEY (filme_id) REFERENCES filme (id)');
        $this->addSql('CREATE INDEX IDX_22C49E3EE6E418AD ON critica (filme_id)');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F0085D01195');
        $this->addSql('DROP INDEX IDX_3A387F0085D01195 ON filme');
        $this->addSql('ALTER TABLE filme DROP texto_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critica DROP FOREIGN KEY FK_22C49E3EE6E418AD');
        $this->addSql('DROP INDEX IDX_22C49E3EE6E418AD ON critica');
        $this->addSql('ALTER TABLE critica DROP filme_id');
        $this->addSql('ALTER TABLE filme ADD texto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F0085D01195 FOREIGN KEY (texto_id) REFERENCES critica (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3A387F0085D01195 ON filme (texto_id)');
    }
}
