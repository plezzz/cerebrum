<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520194355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workplace (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(255) NOT NULL, employer VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, work_from DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', work_to DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_work_here TINYINT(1) DEFAULT NULL, responsibilities LONGTEXT DEFAULT NULL, sector LONGTEXT DEFAULT NULL, department VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, postcode VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, website_of_organization VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workplaces (id INT AUTO_INCREMENT NOT NULL, is_working TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE workplace');
        $this->addSql('DROP TABLE workplaces');
    }
}
