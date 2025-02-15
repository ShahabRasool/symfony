<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215174410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passport ADD citizen_id INT NOT NULL');
        $this->addSql('ALTER TABLE passport ADD CONSTRAINT FK_B5A26E08A63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5A26E08A63C3C2E ON passport (citizen_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passport DROP FOREIGN KEY FK_B5A26E08A63C3C2E');
        $this->addSql('DROP INDEX UNIQ_B5A26E08A63C3C2E ON passport');
        $this->addSql('ALTER TABLE passport DROP citizen_id');
    }
}
