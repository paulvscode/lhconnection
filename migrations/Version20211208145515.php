<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208145515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_article_category (article_id INT NOT NULL, article_category_id INT NOT NULL, PRIMARY KEY(article_id, article_category_id))');
        $this->addSql('CREATE INDEX IDX_44F096D97294869C ON article_article_category (article_id)');
        $this->addSql('CREATE INDEX IDX_44F096D988C5F785 ON article_article_category (article_category_id)');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D988C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE article_article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE article_article (article_source INT NOT NULL, article_target INT NOT NULL, PRIMARY KEY(article_source, article_target))');
        $this->addSql('CREATE INDEX idx_efe84ad12ca8b87c ON article_article (article_target)');
        $this->addSql('CREATE INDEX idx_efe84ad1354de8f3 ON article_article (article_source)');
        $this->addSql('ALTER TABLE article_article ADD CONSTRAINT fk_efe84ad1354de8f3 FOREIGN KEY (article_source) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_article ADD CONSTRAINT fk_efe84ad12ca8b87c FOREIGN KEY (article_target) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE article_article_category');
    }
}
