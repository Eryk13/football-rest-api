<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220151359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fixture ADD result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE7A7B643 FOREIGN KEY (result_id) REFERENCES result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E540EE7A7B643 ON fixture (result_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fixture DROP CONSTRAINT FK_5E540EE7A7B643');
        $this->addSql('DROP INDEX UNIQ_5E540EE7A7B643');
        $this->addSql('ALTER TABLE fixture DROP result_id');
    }
}
