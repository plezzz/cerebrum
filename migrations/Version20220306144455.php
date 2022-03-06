<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306144455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation_note ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE psychiatric_evaluation_note ADD CONSTRAINT FK_A568A5276B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_A568A5276B899279 ON psychiatric_evaluation_note (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation_note DROP FOREIGN KEY FK_A568A5276B899279');
        $this->addSql('DROP INDEX IDX_A568A5276B899279 ON psychiatric_evaluation_note');
        $this->addSql('ALTER TABLE psychiatric_evaluation_note DROP patient_id');
    }
}
