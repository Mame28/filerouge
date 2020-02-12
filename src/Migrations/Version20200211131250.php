<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211131250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taxe_etats ADD taxe_emet DOUBLE PRECISION NOT NULL, ADD taxe_recep DOUBLE PRECISION NOT NULL, ADD taxe_sys DOUBLE PRECISION NOT NULL, ADD taxe_etat DOUBLE PRECISION NOT NULL, DROP taxe_emetteur, DROP taxe_recepteur, DROP taxe_systeme, DROP text_etat');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taxe_etats ADD taxe_emetteur DOUBLE PRECISION NOT NULL, ADD taxe_recepteur DOUBLE PRECISION NOT NULL, ADD taxe_systeme DOUBLE PRECISION NOT NULL, ADD text_etat DOUBLE PRECISION NOT NULL, DROP taxe_emet, DROP taxe_recep, DROP taxe_sys, DROP taxe_etat');
    }
}
