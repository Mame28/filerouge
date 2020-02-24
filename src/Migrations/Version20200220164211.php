<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220164211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE affectaion');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA3736A6193D6 FOREIGN KEY (contrats_id) REFERENCES contrat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32FFA3736A6193D6 ON partenaire (contrats_id)');
        $this->addSql('ALTER TABLE affectation ADD date_debut DATE NOT NULL, ADD date_fin DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affectaion (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_331D556DF2C56620 (compte_id), INDEX IDX_331D556DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE affectaion ADD CONSTRAINT FK_331D556DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE affectaion ADD CONSTRAINT FK_331D556DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE affectation DROP date_debut, DROP date_fin');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA3736A6193D6');
        $this->addSql('DROP INDEX UNIQ_32FFA3736A6193D6 ON partenaire');
    }
}
