<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604102215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workplaces DROP FOREIGN KEY FK_5C6CFBE66B899279');
        $this->addSql('DROP INDEX IDX_5C6CFBE66B899279 ON workplaces');
        $this->addSql('ALTER TABLE workplaces DROP patient_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workplaces ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE workplaces ADD CONSTRAINT FK_5C6CFBE66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_5C6CFBE66B899279 ON workplaces (patient_id)');
    }
}
