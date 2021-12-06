<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206180807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN article.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE article_category (id INT NOT NULL, label VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN event.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE event_event_category (event_id INT NOT NULL, event_category_id INT NOT NULL, PRIMARY KEY(event_id, event_category_id))');
        $this->addSql('CREATE INDEX IDX_9FE4466271F7E88B ON event_event_category (event_id)');
        $this->addSql('CREATE INDEX IDX_9FE44662B9CF4E62 ON event_event_category (event_category_id)');
        $this->addSql('CREATE TABLE event_category (id INT NOT NULL, icon VARCHAR(255) DEFAULT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN project.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE project_category (id INT NOT NULL, label VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE4466271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE44662B9CF4E62 FOREIGN KEY (event_category_id) REFERENCES event_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event_event_category DROP CONSTRAINT FK_9FE4466271F7E88B');
        $this->addSql('ALTER TABLE event_event_category DROP CONSTRAINT FK_9FE44662B9CF4E62');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_event_category');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_category');
        $this->addSql('DROP TABLE "user"');
    }
}
