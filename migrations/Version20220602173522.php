<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602173522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE country MODIFY country_id INT NOT NULL');
//        $this->addSql('ALTER TABLE country DROP PRIMARY KEY');
//        $this->addSql('ALTER TABLE country CHANGE address_format address_format LONGTEXT NOT NULL, CHANGE postcode_required postcode_required SMALLINT NOT NULL, CHANGE status status SMALLINT NOT NULL, CHANGE country_id id INT AUTO_INCREMENT NOT NULL, CHANGE iso_code_2 iso_code2 VARCHAR(2) NOT NULL, CHANGE iso_code_3 iso_code3 VARCHAR(3) NOT NULL');
//        $this->addSql('ALTER TABLE country ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE country MODIFY id INT NOT NULL');
//        $this->addSql('ALTER TABLE country DROP PRIMARY KEY');
//        $this->addSql('ALTER TABLE country ADD iso_code_2 VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, ADD iso_code_3 VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, DROP iso_code2, DROP iso_code3, CHANGE name name VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE address_format address_format TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE postcode_required postcode_required TINYINT(1) NOT NULL, CHANGE status status TINYINT(1) DEFAULT 1 NOT NULL, CHANGE id country_id INT AUTO_INCREMENT NOT NULL');
//        $this->addSql('ALTER TABLE country ADD PRIMARY KEY (country_id)');
    }
}
