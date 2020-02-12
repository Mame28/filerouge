<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212071833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD compte_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD prenom_e VARCHAR(255) DEFAULT NULL, ADD nom_e VARCHAR(255) DEFAULT NULL, ADD type_piece_envoi VARCHAR(255) DEFAULT NULL, ADD tel_emetteur INT DEFAULT NULL, ADD prenom_r VARCHAR(255) DEFAULT NULL, ADD nom_r VARCHAR(255) DEFAULT NULL, ADD montant VARCHAR(255) DEFAULT NULL, ADD numpiece_emetteur INT DEFAULT NULL, ADD num_piece_recepteur INT DEFAULT NULL, ADD status TINYINT(1) DEFAULT NULL, ADD commision_emetteur INT DEFAULT NULL, ADD commission_recepteur INT DEFAULT NULL, ADD commission_etat INT DEFAULT NULL, ADD commission_systeme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F2C56620 ON transaction (compte_id)');
        $this->addSql('CREATE INDEX IDX_723705D1A76ED395 ON transaction (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F2C56620');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1A76ED395');
        $this->addSql('DROP INDEX IDX_723705D1F2C56620 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1A76ED395 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP compte_id, DROP user_id, DROP prenom_e, DROP nom_e, DROP type_piece_envoi, DROP tel_emetteur, DROP prenom_r, DROP nom_r, DROP montant, DROP numpiece_emetteur, DROP num_piece_recepteur, DROP status, DROP commision_emetteur, DROP commission_recepteur, DROP commission_etat, DROP commission_systeme');
    }
}
