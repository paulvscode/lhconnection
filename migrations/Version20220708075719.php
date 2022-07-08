<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220708075719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ALTER responsible TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE project ALTER responsible DROP DEFAULT');
        $this->addSql('ALTER TABLE project ALTER updated_at SET DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN project.responsible IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project ALTER responsible TYPE TEXT');
        $this->addSql('ALTER TABLE project ALTER responsible DROP DEFAULT');
        $this->addSql('ALTER TABLE project ALTER updated_at DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN project.responsible IS \'(DC2Type:array)\'');
    }
}
