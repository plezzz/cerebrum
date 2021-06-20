<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619211924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE psychiatric_evaluation_patient (psychiatric_evaluation_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_F76DEB887021B008 (psychiatric_evaluation_id), INDEX IDX_F76DEB886B899279 (patient_id), PRIMARY KEY(psychiatric_evaluation_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C42F7784B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE psychiatric_evaluation_patient ADD CONSTRAINT FK_F76DEB887021B008 FOREIGN KEY (psychiatric_evaluation_id) REFERENCES psychiatric_evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE psychiatric_evaluation_patient ADD CONSTRAINT FK_F76DEB886B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP FOREIGN KEY FK_D0FCF3CBEA724598');
        $this->addSql('DROP INDEX IDX_D0FCF3CBEA724598 ON psychiatric_evaluation');
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP patient_id_id, CHANGE diagnostic diagnostic LONGTEXT DEFAULT NULL, CHANGE mkb mkb LONGTEXT DEFAULT NULL, CHANGE medical_history medical_history LONGTEXT DEFAULT NULL, CHANGE concomitant_diseases concomitant_diseases LONGTEXT DEFAULT NULL, CHANGE psychiatric_evaluation psychiatric_evaluation LONGTEXT DEFAULT NULL, CHANGE observation_period_to observation_period_to DATETIME DEFAULT NULL, CHANGE expert_opinion expert_opinion LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE psychiatric_evaluation_patient');
        $this->addSql('DROP TABLE report');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD patient_id_id INT DEFAULT NULL, CHANGE diagnostic diagnostic LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mkb mkb LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE medical_history medical_history LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE concomitant_diseases concomitant_diseases LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE psychiatric_evaluation psychiatric_evaluation LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE observation_period_to observation_period_to DATETIME NOT NULL, CHANGE expert_opinion expert_opinion LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD CONSTRAINT FK_D0FCF3CBEA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_D0FCF3CBEA724598 ON psychiatric_evaluation (patient_id_id)');
    }
}
