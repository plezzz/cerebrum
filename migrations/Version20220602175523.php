<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602175523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE address_format address_format LONGTEXT NOT NULL, CHANGE postcode_required postcode_required SMALLINT NOT NULL, CHANGE status status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE workplaces ADD created_by_id INT NOT NULL, ADD edited_by_id INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE workplaces ADD CONSTRAINT FK_5C6CFBE6B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE workplaces ADD CONSTRAINT FK_5C6CFBE6DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5C6CFBE6B03A8386 ON workplaces (created_by_id)');
        $this->addSql('CREATE INDEX IDX_5C6CFBE6DD7B2EBC ON workplaces (edited_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country CHANGE id id INT NOT NULL, CHANGE name name VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE iso_code2 iso_code2 VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE iso_code3 iso_code3 VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE address_format address_format TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE postcode_required postcode_required TINYINT(1) NOT NULL, CHANGE status status TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE workplaces DROP FOREIGN KEY FK_5C6CFBE6B03A8386');
        $this->addSql('ALTER TABLE workplaces DROP FOREIGN KEY FK_5C6CFBE6DD7B2EBC');
        $this->addSql('DROP INDEX IDX_5C6CFBE6B03A8386 ON workplaces');
        $this->addSql('DROP INDEX IDX_5C6CFBE6DD7B2EBC ON workplaces');
        $this->addSql('ALTER TABLE workplaces DROP created_by_id, DROP edited_by_id, DROP created_at, DROP edited_at');
    }
}
