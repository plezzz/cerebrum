<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619123855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, degree VARCHAR(255) NOT NULL, school_name VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, more_information TINYINT(1) NOT NULL, postcode VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, learning_from DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', learning_to DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_learning_here TINYINT(1) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', phone VARCHAR(255) DEFAULT NULL, INDEX IDX_F99EDABBF92F3E70 (country_id), INDEX IDX_F99EDABBB03A8386 (created_by_id), INDEX IDX_F99EDABBDD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schools (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, patient_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_47443BD5B03A8386 (created_by_id), INDEX IDX_47443BD5DD7B2EBC (edited_by_id), UNIQUE INDEX UNIQ_47443BD56B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schools_school (schools_id INT NOT NULL, school_id INT NOT NULL, INDEX IDX_3C5B78B9A000581D (schools_id), INDEX IDX_3C5B78B9C32A47EE (school_id), PRIMARY KEY(schools_id, school_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schools ADD CONSTRAINT FK_47443BD5B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schools ADD CONSTRAINT FK_47443BD5DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schools ADD CONSTRAINT FK_47443BD56B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE schools_school ADD CONSTRAINT FK_3C5B78B9A000581D FOREIGN KEY (schools_id) REFERENCES schools (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schools_school ADD CONSTRAINT FK_3C5B78B9C32A47EE FOREIGN KEY (school_id) REFERENCES school (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schools_school DROP FOREIGN KEY FK_3C5B78B9C32A47EE');
        $this->addSql('ALTER TABLE schools_school DROP FOREIGN KEY FK_3C5B78B9A000581D');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE schools');
        $this->addSql('DROP TABLE schools_school');
    }
}
