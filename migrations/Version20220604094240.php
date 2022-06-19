<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604094240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, iso_code2 VARCHAR(2) NOT NULL, iso_code3 VARCHAR(3) NOT NULL, adress_format LONGTEXT NOT NULL, postcode_required TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workplace ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE workplace ADD CONSTRAINT FK_D0FB92EEF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_D0FB92EEF92F3E70 ON workplace (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workplace DROP FOREIGN KEY FK_D0FB92EEF92F3E70');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_D0FB92EEF92F3E70 ON workplace');
        $this->addSql('ALTER TABLE workplace DROP country_id');
    }
}
