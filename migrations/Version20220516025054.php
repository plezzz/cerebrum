<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516025054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE temperature_list (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', notes LONGTEXT DEFAULT NULL, INDEX IDX_8AE27EE9B03A8386 (created_by_id), INDEX IDX_8AE27EE9DD7B2EBC (edited_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE therapy (id INT AUTO_INCREMENT NOT NULL, drug LONGTEXT NOT NULL, amount DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, morning VARCHAR(255) NOT NULL, lunch VARCHAR(255) NOT NULL, evening VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temperature_list ADD CONSTRAINT FK_8AE27EE9B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE temperature_list ADD CONSTRAINT FK_8AE27EE9DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE temperature_list');
        $this->addSql('DROP TABLE therapy');
    }
}
