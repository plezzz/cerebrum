<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602180206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
      //  $this->addSql('ALTER TABLE workplace ADD country_id INT NOT NULL, DROP country');
       // $this->addSql('ALTER TABLE workplace ADD CONSTRAINT FK_D0FB92EEF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
      //  $this->addSql('CREATE INDEX IDX_D0FB92EEF92F3E70 ON workplace (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country CHANGE name name VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE iso_code2 iso_code2 VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE iso_code3 iso_code3 VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE address_format address_format LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE workplace DROP FOREIGN KEY FK_D0FB92EEF92F3E70');
        $this->addSql('DROP INDEX IDX_D0FB92EEF92F3E70 ON workplace');
        $this->addSql('ALTER TABLE workplace ADD country VARCHAR(255) DEFAULT NULL, DROP country_id');
    }
}
