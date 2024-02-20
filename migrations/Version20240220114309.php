<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220114309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fixture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fixture (id INT NOT NULL, home_club_id INT DEFAULT NULL, away_club_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E540EED439C16A ON fixture (home_club_id)');
        $this->addSql('CREATE INDEX IDX_5E540EED6D8F9E ON fixture (away_club_id)');
        $this->addSql('CREATE TABLE result (id INT NOT NULL, home_club_score INT NOT NULL, away_club_score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EED439C16A FOREIGN KEY (home_club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EED6D8F9E FOREIGN KEY (away_club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament ADD type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fixture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE result_id_seq CASCADE');
        $this->addSql('ALTER TABLE fixture DROP CONSTRAINT FK_5E540EED439C16A');
        $this->addSql('ALTER TABLE fixture DROP CONSTRAINT FK_5E540EED6D8F9E');
        $this->addSql('DROP TABLE fixture');
        $this->addSql('DROP TABLE result');
        $this->addSql('ALTER TABLE tournament DROP type');
    }
}
