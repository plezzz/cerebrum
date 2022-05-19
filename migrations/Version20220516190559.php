<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516190559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
      //  $this->addSql('ALTER TABLE therapy ADD CONSTRAINT FK_BEFB27223FCAF9B9 FOREIGN KEY (temperature_list_id) REFERENCES temperature_list (id)');
       // $this->addSql('CREATE INDEX IDX_BEFB27223FCAF9B9 ON therapy (temperature_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
     //   $this->addSql('ALTER TABLE therapy DROP FOREIGN KEY FK_BEFB27223FCAF9B9');
     //   $this->addSql('DROP INDEX IDX_BEFB27223FCAF9B9 ON therapy');
    }
}
