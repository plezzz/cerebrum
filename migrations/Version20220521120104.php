<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521120104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workplaces_workplace (workplaces_id INT NOT NULL, workplace_id INT NOT NULL, INDEX IDX_D00925B578627C7B (workplaces_id), INDEX IDX_D00925B5AC25FB46 (workplace_id), PRIMARY KEY(workplaces_id, workplace_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workplaces_workplace ADD CONSTRAINT FK_D00925B578627C7B FOREIGN KEY (workplaces_id) REFERENCES workplaces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workplaces_workplace ADD CONSTRAINT FK_D00925B5AC25FB46 FOREIGN KEY (workplace_id) REFERENCES workplace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workplace ADD created_by_id INT NOT NULL, ADD edited_by_id INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE workplace ADD CONSTRAINT FK_D0FB92EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE workplace ADD CONSTRAINT FK_D0FB92EEDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D0FB92EEB03A8386 ON workplace (created_by_id)');
        $this->addSql('CREATE INDEX IDX_D0FB92EEDD7B2EBC ON workplace (edited_by_id)');
        $this->addSql('ALTER TABLE workplaces ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE workplaces ADD CONSTRAINT FK_5C6CFBE66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_5C6CFBE66B899279 ON workplaces (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE workplaces_workplace');
        $this->addSql('ALTER TABLE workplace DROP FOREIGN KEY FK_D0FB92EEB03A8386');
        $this->addSql('ALTER TABLE workplace DROP FOREIGN KEY FK_D0FB92EEDD7B2EBC');
        $this->addSql('DROP INDEX IDX_D0FB92EEB03A8386 ON workplace');
        $this->addSql('DROP INDEX IDX_D0FB92EEDD7B2EBC ON workplace');
        $this->addSql('ALTER TABLE workplace DROP created_by_id, DROP edited_by_id, DROP created_at, DROP edited_at');
        $this->addSql('ALTER TABLE workplaces DROP FOREIGN KEY FK_5C6CFBE66B899279');
        $this->addSql('DROP INDEX IDX_5C6CFBE66B899279 ON workplaces');
        $this->addSql('ALTER TABLE workplaces DROP patient_id');
    }
}
