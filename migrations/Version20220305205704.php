<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305205704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_evaluation (id INT AUTO_INCREMENT NOT NULL, edited_by_id INT DEFAULT NULL, creted_by_id INT DEFAULT NULL, social_status VARCHAR(255) DEFAULT NULL, needs VARCHAR(255) DEFAULT NULL, assessment VARCHAR(255) DEFAULT NULL, recommendation VARCHAR(255) DEFAULT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, edited_at DATETIME NOT NULL, INDEX IDX_DD7017B7DD7B2EBC (edited_by_id), INDEX IDX_DD7017B76E39655A (creted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_evaluation_patient (social_evaluation_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_6A9FFD41F3D6D8D2 (social_evaluation_id), INDEX IDX_6A9FFD416B899279 (patient_id), PRIMARY KEY(social_evaluation_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B7DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B76E39655A FOREIGN KEY (creted_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE social_evaluation_patient ADD CONSTRAINT FK_6A9FFD41F3D6D8D2 FOREIGN KEY (social_evaluation_id) REFERENCES social_evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_evaluation_patient ADD CONSTRAINT FK_6A9FFD416B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user2');
        $this->addSql('ALTER TABLE contacts CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE type_of_contact type_of_contact VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE middle_name middle_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE egn egn VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE mobile_phone mobile_phone INT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE edited_at edited_at DATETIME NOT NULL, CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_evaluation_patient DROP FOREIGN KEY FK_6A9FFD41F3D6D8D2');
        $this->addSql('CREATE TABLE user2 (id INT AUTO_INCREMENT NOT NULL, adsdkasd VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, jjdjsadj VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE social_evaluation');
        $this->addSql('DROP TABLE social_evaluation_patient');
        $this->addSql('ALTER TABLE contacts CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE type_of_contact type_of_contact VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE egn egn VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE mobile_phone mobile_phone INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE edited_at edited_at DATETIME DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE is_deleted is_deleted TINYINT(1) DEFAULT NULL');
    }
}
