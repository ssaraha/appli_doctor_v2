<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220107150250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_languages (user_id INT NOT NULL, languages_id INT NOT NULL, INDEX IDX_A031DE9DA76ED395 (user_id), INDEX IDX_A031DE9D5D237A9A (languages_id), PRIMARY KEY(user_id, languages_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_languages ADD CONSTRAINT FK_A031DE9DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_languages ADD CONSTRAINT FK_A031DE9D5D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE languages ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_languages');
        $this->addSql('ALTER TABLE clinic DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE languages DROP created_at, DROP updated_at');
    }
}
