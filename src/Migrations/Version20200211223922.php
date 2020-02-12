<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211223922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD prenom_e VARCHAR(255) DEFAULT NULL, ADD nom_e VARCHAR(255) DEFAULT NULL, ADD num_piece_emetteur VARCHAR(255) DEFAULT NULL, ADD prenom_r VARCHAR(255) DEFAULT NULL, ADD nom_r VARCHAR(255) DEFAULT NULL, ADD montant VARCHAR(255) DEFAULT NULL, ADD frais VARCHAR(255) NOT NULL, ADD tel_recepteur INT DEFAULT NULL, ADD date_envoi DATETIME DEFAULT NULL, ADD tel_emetteur INT DEFAULT NULL, ADD commission_emetteur VARCHAR(255) DEFAULT NULL, ADD commission_recepteur INT NOT NULL, ADD commission_systeme INT NOT NULL, ADD commission_etat INT NOT NULL, ADD statu TINYINT(1) NOT NULL, ADD code INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP prenom_e, DROP nom_e, DROP num_piece_emetteur, DROP prenom_r, DROP nom_r, DROP montant, DROP frais, DROP tel_recepteur, DROP date_envoi, DROP tel_emetteur, DROP commission_emetteur, DROP commission_recepteur, DROP commission_systeme, DROP commission_etat, DROP statu, DROP code');
    }
}
