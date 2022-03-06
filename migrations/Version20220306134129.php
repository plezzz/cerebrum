<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306134129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE psychiatric_evaluation_note (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, note LONGTEXT NOT NULL, created_at DATETIME NOT NULL, edited_at DATETIME NOT NULL, INDEX IDX_A568A527B03A8386 (created_by_id), INDEX IDX_A568A527DD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE psychiatric_evaluation_note ADD CONSTRAINT FK_A568A527B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychiatric_evaluation_note ADD CONSTRAINT FK_A568A527DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP diagnostic, DROP mkb, DROP medical_history, DROP concomitant_diseases, DROP psychiatric_evaluation, DROP observation_period_from, DROP observation_period_to, DROP expert_opinion');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE psychiatric_evaluation_note');
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD diagnostic LONGTEXT DEFAULT NULL, ADD mkb LONGTEXT DEFAULT NULL, ADD medical_history LONGTEXT DEFAULT NULL, ADD concomitant_diseases LONGTEXT DEFAULT NULL, ADD psychiatric_evaluation LONGTEXT DEFAULT NULL, ADD observation_period_from DATETIME NOT NULL, ADD observation_period_to DATETIME DEFAULT NULL, ADD expert_opinion LONGTEXT DEFAULT NULL');
    }
}
