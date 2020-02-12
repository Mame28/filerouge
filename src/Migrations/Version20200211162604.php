<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211162604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD tel_emetteur INT NOT NULL, CHANGE date_retrait date_retrait DATETIME NOT NULL, CHANGE type_piece_recepteur type_piece_recepteur VARCHAR(255) NOT NULL, CHANGE telephone_recepteur telephone_recepteur INT NOT NULL, CHANGE numero_piece_recpteur numero_piece_recpteur INT NOT NULL, CHANGE commission_recepteur commission_recepteur DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP tel_emetteur, CHANGE date_retrait date_retrait DATETIME DEFAULT NULL, CHANGE type_piece_recepteur type_piece_recepteur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone_recepteur telephone_recepteur INT DEFAULT NULL, CHANGE numero_piece_recpteur numero_piece_recpteur INT DEFAULT NULL, CHANGE commission_recepteur commission_recepteur DOUBLE PRECISION DEFAULT NULL');
    }
}
