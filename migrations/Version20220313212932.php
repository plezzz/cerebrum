<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313212932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE psychological_evaluation (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, family_history LONGTEXT DEFAULT NULL, personal_history LONGTEXT DEFAULT NULL, psychological_profile LONGTEXT DEFAULT NULL, therapeutic_plan LONGTEXT DEFAULT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1861FCA7B03A8386 (created_by_id), INDEX IDX_1861FCA7DD7B2EBC (edited_by_id), UNIQUE INDEX UNIQ_1861FCA76B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE psychological_evaluation_note (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, note LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_572159D8B03A8386 (created_by_id), INDEX IDX_572159D8DD7B2EBC (edited_by_id), INDEX IDX_572159D86B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE psychological_evaluation ADD CONSTRAINT FK_1861FCA7B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychological_evaluation ADD CONSTRAINT FK_1861FCA7DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychological_evaluation ADD CONSTRAINT FK_1861FCA76B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE psychological_evaluation_note ADD CONSTRAINT FK_572159D8B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychological_evaluation_note ADD CONSTRAINT FK_572159D8DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychological_evaluation_note ADD CONSTRAINT FK_572159D86B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE psychological_evaluation');
        $this->addSql('DROP TABLE psychological_evaluation_note');
    }
}
