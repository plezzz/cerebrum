<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220227194514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
      //  $this->addSql('CREATE TABLE user2 (id INT AUTO_INCREMENT NOT NULL, adsdkasd VARCHAR(255) DEFAULT NULL, jjdjsadj VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
      //  $this->addSql('ALTER TABLE contacts CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE type_of_contact type_of_contact VARCHAR(255) NOT NULL');
     //   $this->addSql('ALTER TABLE patient CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE middle_name middle_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE egn egn VARCHAR(10) NOT NULL');
    //    $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE mobile_phone mobile_phone INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE edited_at edited_at DATETIME NOT NULL, CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user2');
        $this->addSql('ALTER TABLE contacts CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE mobile_phone mobile_phone VARCHAR(255) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE type_of_contact type_of_contact VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE middle_name middle_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE egn egn VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE mobile_phone mobile_phone INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE edited_at edited_at DATETIME DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE is_deleted is_deleted TINYINT(1) DEFAULT NULL');
    }
}
