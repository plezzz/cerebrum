<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516121822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE temperature_list ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE temperature_list ADD CONSTRAINT FK_8AE27EE96B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_8AE27EE96B899279 ON temperature_list (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE temperature_list DROP FOREIGN KEY FK_8AE27EE96B899279');
        $this->addSql('DROP INDEX IDX_8AE27EE96B899279 ON temperature_list');
        $this->addSql('ALTER TABLE temperature_list DROP patient_id');
    }
}
