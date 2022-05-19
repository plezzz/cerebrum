<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516035352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE temperature_list_therapy (temperature_list_id INT NOT NULL, therapy_id INT NOT NULL, INDEX IDX_4AA141D93FCAF9B9 (temperature_list_id), INDEX IDX_4AA141D9AD22CEF1 (therapy_id), PRIMARY KEY(temperature_list_id, therapy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temperature_list_therapy ADD CONSTRAINT FK_4AA141D93FCAF9B9 FOREIGN KEY (temperature_list_id) REFERENCES temperature_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE temperature_list_therapy ADD CONSTRAINT FK_4AA141D9AD22CEF1 FOREIGN KEY (therapy_id) REFERENCES therapy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE temperature_list_therapy');
    }
}
