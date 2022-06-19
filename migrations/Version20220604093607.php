<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604093607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE country');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, iso_code2 VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, iso_code3 VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, address_format LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, postcode_required SMALLINT NOT NULL, status SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
    }
}
