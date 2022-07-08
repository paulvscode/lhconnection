<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220708092332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE responsible_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE project_responsible (project_id INT NOT NULL, responsible_id INT NOT NULL, PRIMARY KEY(project_id, responsible_id))');
        $this->addSql('CREATE INDEX IDX_5F29D213166D1F9C ON project_responsible (project_id)');
        $this->addSql('CREATE INDEX IDX_5F29D213602AD315 ON project_responsible (responsible_id)');
        $this->addSql('CREATE TABLE responsible (id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE project_responsible ADD CONSTRAINT FK_5F29D213166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_responsible ADD CONSTRAINT FK_5F29D213602AD315 FOREIGN KEY (responsible_id) REFERENCES responsible (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE team');
        $this->addSql('ALTER TABLE project DROP responsible');
        $this->addSql('ALTER TABLE project ALTER updated_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project_responsible DROP CONSTRAINT FK_5F29D213602AD315');
        $this->addSql('DROP SEQUENCE responsible_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE project_responsible');
        $this->addSql('DROP TABLE responsible');
        $this->addSql('ALTER TABLE project ADD responsible TEXT NOT NULL');
        $this->addSql('ALTER TABLE project ALTER updated_at DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN project.responsible IS \'(DC2Type:array)\'');
    }
}
