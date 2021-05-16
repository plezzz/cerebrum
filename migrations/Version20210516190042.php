<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516190042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP INDEX UNIQ_33401573B03A8386, ADD INDEX IDX_33401573B03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE contacts DROP INDEX UNIQ_33401573DD7B2EBC, ADD INDEX IDX_33401573DD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE details DROP INDEX UNIQ_72260B8AB03A8386, ADD INDEX IDX_72260B8AB03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE details DROP INDEX UNIQ_72260B8ADD7B2EBC, ADD INDEX IDX_72260B8ADD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE idcard DROP INDEX UNIQ_C5DB6973B03A8386, ADD INDEX IDX_C5DB6973B03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE idcard DROP INDEX UNIQ_C5DB6973DD7B2EBC, ADD INDEX IDX_C5DB6973DD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE patient DROP INDEX UNIQ_1ADAD7EBB03A8386, ADD INDEX IDX_1ADAD7EBB03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE patient DROP INDEX UNIQ_1ADAD7EBDD7B2EBC, ADD INDEX IDX_1ADAD7EBDD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE patient CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE edited_by_id edited_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649DD7B2EBC, ADD INDEX IDX_8D93D649DD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649B03A8386, ADD INDEX IDX_8D93D649B03A8386 (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP INDEX IDX_33401573B03A8386, ADD UNIQUE INDEX UNIQ_33401573B03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE contacts DROP INDEX IDX_33401573DD7B2EBC, ADD UNIQUE INDEX UNIQ_33401573DD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE details DROP INDEX IDX_72260B8AB03A8386, ADD UNIQUE INDEX UNIQ_72260B8AB03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE details DROP INDEX IDX_72260B8ADD7B2EBC, ADD UNIQUE INDEX UNIQ_72260B8ADD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE idcard DROP INDEX IDX_C5DB6973B03A8386, ADD UNIQUE INDEX UNIQ_C5DB6973B03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE idcard DROP INDEX IDX_C5DB6973DD7B2EBC, ADD UNIQUE INDEX UNIQ_C5DB6973DD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE patient DROP INDEX IDX_1ADAD7EBB03A8386, ADD UNIQUE INDEX UNIQ_1ADAD7EBB03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE patient DROP INDEX IDX_1ADAD7EBDD7B2EBC, ADD UNIQUE INDEX UNIQ_1ADAD7EBDD7B2EBC (edited_by_id)');
        $this->addSql('ALTER TABLE patient CHANGE created_by_id created_by_id INT NOT NULL, CHANGE edited_by_id edited_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D649B03A8386, ADD UNIQUE INDEX UNIQ_8D93D649B03A8386 (created_by_id)');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D649DD7B2EBC, ADD UNIQUE INDEX UNIQ_8D93D649DD7B2EBC (edited_by_id)');
    }
}
