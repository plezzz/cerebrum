<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313170710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_evaluation_patient DROP FOREIGN KEY FK_6A9FFD41F3D6D8D2');
        $this->addSql('DROP TABLE social_evaluation');
        $this->addSql('DROP TABLE social_evaluation_patient');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_evaluation (id INT AUTO_INCREMENT NOT NULL, edited_by_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, social_status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, needs VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, assessment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, recommendation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, edited_at DATETIME NOT NULL, INDEX IDX_DD7017B7DD7B2EBC (edited_by_id), INDEX IDX_DD7017B7B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE social_evaluation_patient (social_evaluation_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_6A9FFD416B899279 (patient_id), INDEX IDX_6A9FFD41F3D6D8D2 (social_evaluation_id), PRIMARY KEY(social_evaluation_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B7DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B7B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE social_evaluation_patient ADD CONSTRAINT FK_6A9FFD41F3D6D8D2 FOREIGN KEY (social_evaluation_id) REFERENCES social_evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_evaluation_patient ADD CONSTRAINT FK_6A9FFD416B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
    }
}
