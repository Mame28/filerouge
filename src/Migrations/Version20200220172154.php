<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220172154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA3736A6193D6 FOREIGN KEY (contrats_id) REFERENCES contrat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32FFA3736A6193D6 ON partenaire (contrats_id)');
        $this->addSql('ALTER TABLE affectation ADD compte_id INT NOT NULL, ADD user_id INT DEFAULT NULL, ADD date_fin DATE NOT NULL');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3F2C56620 FOREIGN KEY (compte_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D3F2C56620 ON affectation (compte_id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D3A76ED395 ON affectation (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3F2C56620');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3A76ED395');
        $this->addSql('DROP INDEX IDX_F4DD61D3F2C56620 ON affectation');
        $this->addSql('DROP INDEX IDX_F4DD61D3A76ED395 ON affectation');
        $this->addSql('ALTER TABLE affectation DROP compte_id, DROP user_id, DROP date_fin');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA3736A6193D6');
        $this->addSql('DROP INDEX UNIQ_32FFA3736A6193D6 ON partenaire');
    }
}
