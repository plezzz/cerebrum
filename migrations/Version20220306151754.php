<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306151754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE psychiatric_evaluation_patient');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD CONSTRAINT FK_D0FCF3CB6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D0FCF3CB6B899279 ON psychiatric_evaluation (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE psychiatric_evaluation_patient (psychiatric_evaluation_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_F76DEB887021B008 (psychiatric_evaluation_id), INDEX IDX_F76DEB886B899279 (patient_id), PRIMARY KEY(psychiatric_evaluation_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE psychiatric_evaluation_patient ADD CONSTRAINT FK_F76DEB887021B008 FOREIGN KEY (psychiatric_evaluation_id) REFERENCES psychiatric_evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE psychiatric_evaluation_patient ADD CONSTRAINT FK_F76DEB886B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP FOREIGN KEY FK_D0FCF3CB6B899279');
        $this->addSql('DROP INDEX UNIQ_D0FCF3CB6B899279 ON psychiatric_evaluation');
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP patient_id');
    }
}
