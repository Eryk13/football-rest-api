<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220112234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tournament (id INT NOT NULL, name VARCHAR(255) NOT NULL, season VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tournament_club (tournament_id INT NOT NULL, club_id INT NOT NULL, PRIMARY KEY(tournament_id, club_id))');
        $this->addSql('CREATE INDEX IDX_8F638A4C33D1A3E7 ON tournament_club (tournament_id)');
        $this->addSql('CREATE INDEX IDX_8F638A4C61190A32 ON tournament_club (club_id)');
        $this->addSql('ALTER TABLE tournament_club ADD CONSTRAINT FK_8F638A4C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament_club ADD CONSTRAINT FK_8F638A4C61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tournament_id_seq CASCADE');
        $this->addSql('ALTER TABLE tournament_club DROP CONSTRAINT FK_8F638A4C33D1A3E7');
        $this->addSql('ALTER TABLE tournament_club DROP CONSTRAINT FK_8F638A4C61190A32');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE tournament_club');
    }
}
