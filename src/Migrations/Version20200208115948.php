<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200208115948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, montent INT NOT NULL, frais INT NOT NULL, client_emetteur VARCHAR(255) NOT NULL, type_piece_emetteur VARCHAR(255) NOT NULL, numero_piece_ematteur INT NOT NULL, date_envoi DATETIME NOT NULL, tel_emetteur INT NOT NULL, commission_emaiteur INT NOT NULL, deta_retrait DATETIME NOT NULL, client_recepteur VARCHAR(255) NOT NULL, type_piece_recepteur VARCHAR(255) NOT NULL, tel_recepteur INT NOT NULL, numero_piece_recepteur INT NOT NULL, commission_recepteur DOUBLE PRECISION NOT NULL, f VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE images images VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction');
        $this->addSql('ALTER TABLE user CHANGE images images VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
