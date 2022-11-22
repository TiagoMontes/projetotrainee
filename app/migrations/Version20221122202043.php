<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122202043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FBCE7B795');

        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE genero');
        // tentar criar manualmente d:m:generate para fazer o SQL manualmente

        $this->addSql('DROP INDEX IDX_1D5EF26FBCE7B795 ON movie');
        $this->addSql('ALTER TABLE movie CHANGE genero_id genre_id INT NOT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F4296D31F ON movie (genre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F4296D31F');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP INDEX IDX_1D5EF26F4296D31F ON movie');
        $this->addSql('ALTER TABLE movie CHANGE genre_id genero_id INT NOT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1D5EF26FBCE7B795 ON movie (genero_id)');
    }
}
