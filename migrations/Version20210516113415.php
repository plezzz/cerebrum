<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516113415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mobile_phone VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, is_active TINYINT(1) NOT NULL, type_of_contact VARCHAR(255) NOT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_334015736B899279 (patient_id), UNIQUE INDEX UNIQ_33401573B03A8386 (created_by_id), UNIQUE INDEX UNIQ_33401573DD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, sex VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, hair_color VARCHAR(255) NOT NULL, eye_color VARCHAR(255) NOT NULL, marital_status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_72260B8AB03A8386 (created_by_id), UNIQUE INDEX UNIQ_72260B8ADD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idcard (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, idnumber INT NOT NULL, validity DATETIME NOT NULL, place_of_residence_by_id VARCHAR(255) NOT NULL, place_of_residence_by_current_location VARCHAR(255) NOT NULL, published_by VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C5DB6973B03A8386 (created_by_id), UNIQUE INDEX UNIQ_C5DB6973DD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, details_id INT DEFAULT NULL, idcard_id INT DEFAULT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, egn VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EB31EB61E6 (egn), UNIQUE INDEX UNIQ_1ADAD7EBBB1A0722 (details_id), UNIQUE INDEX UNIQ_1ADAD7EB95C8C84E (idcard_id), UNIQUE INDEX UNIQ_1ADAD7EBB03A8386 (created_by_id), UNIQUE INDEX UNIQ_1ADAD7EBDD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_334015736B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8ADD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE idcard ADD CONSTRAINT FK_C5DB6973B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE idcard ADD CONSTRAINT FK_C5DB6973DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBB1A0722 FOREIGN KEY (details_id) REFERENCES details (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB95C8C84E FOREIGN KEY (idcard_id) REFERENCES idcard (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBBB1A0722');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB95C8C84E');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_334015736B899279');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE idcard');
        $this->addSql('DROP TABLE patient');
    }
}
