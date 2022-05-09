<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509190535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habits CHANGE how_often_he_consumes_alcohol how_often_he_consumes_alcohol LONGTEXT DEFAULT NULL, CHANGE how_often_he_uses_drugs how_often_he_uses_drugs LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habits CHANGE how_often_he_consumes_alcohol how_often_he_consumes_alcohol LONGBLOB DEFAULT NULL, CHANGE how_often_he_uses_drugs how_often_he_uses_drugs LONGBLOB DEFAULT NULL');
    }
}
