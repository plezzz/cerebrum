<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326193535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habits (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, patient_id INT NOT NULL, smoking TINYINT(1) NOT NULL, amount_of_cigarettes_per_day INT DEFAULT NULL, alcohol TINYINT(1) NOT NULL, amaount_of_alcohol_per_day INT DEFAULT NULL, how_often_he_consumes_alcohol LONGBLOB DEFAULT NULL, narcotics TINYINT(1) NOT NULL, how_often_he_uses_drugs LONGBLOB DEFAULT NULL, what_type_of_drug_uses LONGTEXT DEFAULT NULL, use_in_the_moment_narcotics TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A541213AB03A8386 (created_by_id), INDEX IDX_A541213ADD7B2EBC (edited_by_id), UNIQUE INDEX UNIQ_A541213A6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habits ADD CONSTRAINT FK_A541213AB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE habits ADD CONSTRAINT FK_A541213ADD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE habits ADD CONSTRAINT FK_A541213A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE habits');
    }
}
