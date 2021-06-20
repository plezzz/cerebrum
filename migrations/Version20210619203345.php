<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619203345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE psychiatric_evaluation (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, diagnostic LONGTEXT NOT NULL, mkb LONGTEXT NOT NULL, medical_history LONGTEXT NOT NULL, concomitant_diseases LONGTEXT NOT NULL, psychiatric_evaluation LONGTEXT NOT NULL, observation_period_from DATETIME NOT NULL, observation_period_to DATETIME NOT NULL, expert_opinion LONGTEXT NOT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, edited_at DATETIME NOT NULL, INDEX IDX_D0FCF3CBEA724598 (patient_id_id), INDEX IDX_D0FCF3CBDD7B2EBC (edited_by_id), INDEX IDX_D0FCF3CBB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD CONSTRAINT FK_D0FCF3CBEA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD CONSTRAINT FK_D0FCF3CBDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD CONSTRAINT FK_D0FCF3CBB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE psychiatric_evaluation');
    }
}
