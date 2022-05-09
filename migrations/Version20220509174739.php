<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509174739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts CHANGE mobile_phone mobile_phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE details CHANGE sex sex VARCHAR(255) DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL, CHANGE height height DOUBLE PRECISION DEFAULT NULL, CHANGE hair_color hair_color VARCHAR(255) DEFAULT NULL, CHANGE eye_color eye_color VARCHAR(255) DEFAULT NULL, CHANGE blood_type blood_type VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts CHANGE mobile_phone mobile_phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE details CHANGE sex sex VARCHAR(255) NOT NULL, CHANGE weight weight DOUBLE PRECISION NOT NULL, CHANGE height height DOUBLE PRECISION NOT NULL, CHANGE hair_color hair_color VARCHAR(255) NOT NULL, CHANGE eye_color eye_color VARCHAR(255) NOT NULL, CHANGE blood_type blood_type VARCHAR(255) NOT NULL');
    }
}
