<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307201824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation_note CHANGE edited_by_id edited_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_evaluation DROP FOREIGN KEY FK_DD7017B76E39655A');
        $this->addSql('DROP INDEX IDX_DD7017B76E39655A ON social_evaluation');
        $this->addSql('ALTER TABLE social_evaluation CHANGE creted_by_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B7B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DD7017B7B03A8386 ON social_evaluation (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation_note CHANGE edited_by_id edited_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_evaluation DROP FOREIGN KEY FK_DD7017B7B03A8386');
        $this->addSql('DROP INDEX IDX_DD7017B7B03A8386 ON social_evaluation');
        $this->addSql('ALTER TABLE social_evaluation CHANGE created_by_id creted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_evaluation ADD CONSTRAINT FK_DD7017B76E39655A FOREIGN KEY (creted_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DD7017B76E39655A ON social_evaluation (creted_by_id)');
    }
}
