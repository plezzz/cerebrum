<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306141252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation ADD anamnesis_wastaken LONGTEXT DEFAULT NULL, ADD past_illnesses LONGTEXT DEFAULT NULL, ADD accompanying_diseases LONGTEXT DEFAULT NULL, ADD family_history LONGTEXT DEFAULT NULL, ADD premorbid_development LONGTEXT DEFAULT NULL, ADD early_development LONGTEXT DEFAULT NULL, ADD pregnancy LONGTEXT DEFAULT NULL, ADD birth LONGTEXT DEFAULT NULL, ADD neonatal_period LONGTEXT DEFAULT NULL, ADD nutrition LONGTEXT DEFAULT NULL, ADD motor_development LONGTEXT DEFAULT NULL, ADD speech_development_and_communication LONGTEXT DEFAULT NULL, ADD self_service LONGTEXT DEFAULT NULL, ADD socialization LONGTEXT DEFAULT NULL, ADD behavior LONGTEXT DEFAULT NULL, ADD family LONGTEXT DEFAULT NULL, ADD style_of_attachment LONGTEXT DEFAULT NULL, ADD medical_history LONGTEXT DEFAULT NULL, ADD hospitalization LONGTEXT DEFAULT NULL, ADD last_hospitalization LONGTEXT DEFAULT NULL, ADD manifestations_of_autoaggression_or_aggression LONGTEXT DEFAULT NULL, ADD allergies LONGTEXT DEFAULT NULL, ADD life_style LONGTEXT DEFAULT NULL, ADD surfactant_abuse LONGTEXT DEFAULT NULL, ADD problems_with_the_law LONGTEXT DEFAULT NULL, ADD somatic_status LONGTEXT DEFAULT NULL, ADD neurological_status LONGTEXT DEFAULT NULL, ADD mental_status LONGTEXT DEFAULT NULL, ADD syndrome LONGTEXT DEFAULT NULL, ADD differential_diagnosis LONGTEXT DEFAULT NULL, ADD therapeutic_plan LONGTEXT DEFAULT NULL, ADD therapy LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE psychiatric_evaluation DROP anamnesis_wastaken, DROP past_illnesses, DROP accompanying_diseases, DROP family_history, DROP premorbid_development, DROP early_development, DROP pregnancy, DROP birth, DROP neonatal_period, DROP nutrition, DROP motor_development, DROP speech_development_and_communication, DROP self_service, DROP socialization, DROP behavior, DROP family, DROP style_of_attachment, DROP medical_history, DROP hospitalization, DROP last_hospitalization, DROP manifestations_of_autoaggression_or_aggression, DROP allergies, DROP life_style, DROP surfactant_abuse, DROP problems_with_the_law, DROP somatic_status, DROP neurological_status, DROP mental_status, DROP syndrome, DROP differential_diagnosis, DROP therapeutic_plan, DROP therapy');
    }
}
