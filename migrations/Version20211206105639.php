<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206105639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_event_category (event_id INT NOT NULL, event_category_id INT NOT NULL, PRIMARY KEY(event_id, event_category_id))');
        $this->addSql('CREATE INDEX IDX_9FE4466271F7E88B ON event_event_category (event_id)');
        $this->addSql('CREATE INDEX IDX_9FE44662B9CF4E62 ON event_event_category (event_category_id)');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE4466271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE44662B9CF4E62 FOREIGN KEY (event_category_id) REFERENCES event_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event DROP category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE event_event_category');
        $this->addSql('ALTER TABLE event ADD category VARCHAR(255) NOT NULL');
    }
}
