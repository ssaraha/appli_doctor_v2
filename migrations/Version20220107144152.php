<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220107144152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between user and clinic';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD clinic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CC22AD4 ON user (clinic_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CC22AD4');
        $this->addSql('DROP INDEX IDX_8D93D649CC22AD4 ON user');
        $this->addSql('ALTER TABLE user DROP clinic_id');
    }
}
