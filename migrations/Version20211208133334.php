<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208133334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_project (project_source INT NOT NULL, project_target INT NOT NULL, PRIMARY KEY(project_source, project_target))');
        $this->addSql('CREATE INDEX IDX_B9ADDC8B482E9439 ON project_project (project_source)');
        $this->addSql('CREATE INDEX IDX_B9ADDC8B51CBC4B6 ON project_project (project_target)');
        $this->addSql('ALTER TABLE project_project ADD CONSTRAINT FK_B9ADDC8B482E9439 FOREIGN KEY (project_source) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_project ADD CONSTRAINT FK_B9ADDC8B51CBC4B6 FOREIGN KEY (project_target) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE project_project');
    }
}
