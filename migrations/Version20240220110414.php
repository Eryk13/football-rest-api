<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220110414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE club_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nationality_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE club (id INT NOT NULL, name VARCHAR(255) NOT NULL, stadium_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nationality (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE player ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD nationality_id INT NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6561190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A651C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_98197A6561190A32 ON player (club_id)');
        $this->addSql('CREATE INDEX IDX_98197A651C9DA55 ON player (nationality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A6561190A32');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A651C9DA55');
        $this->addSql('DROP SEQUENCE club_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nationality_id_seq CASCADE');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE nationality');
        $this->addSql('DROP INDEX IDX_98197A6561190A32');
        $this->addSql('DROP INDEX IDX_98197A651C9DA55');
        $this->addSql('ALTER TABLE player DROP club_id');
        $this->addSql('ALTER TABLE player DROP nationality_id');
    }
}
