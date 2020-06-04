<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604170810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, nom_agence VARCHAR(50) NOT NULL, id_agence VARCHAR(50) NOT NULL, contact_name_agence VARCHAR(100) NOT NULL, phone_agence VARCHAR(100) NOT NULL, email_agence VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_64C19AA9A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, nom_currency VARCHAR(20) NOT NULL, code_currency VARCHAR(20) NOT NULL, INDEX IDX_6956883FA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destinataire (id INT AUTO_INCREMENT NOT NULL, expediteur_id INT DEFAULT NULL, id_dest VARCHAR(100) NOT NULL, nom_dest VARCHAR(100) NOT NULL, prenom_dest VARCHAR(100) NOT NULL, ville_dest VARCHAR(50) DEFAULT NULL, phone_dest VARCHAR(50) NOT NULL, email_dest VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_FEA9FF9210335F61 (expediteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expediteur (id INT AUTO_INCREMENT NOT NULL, id_exp VARCHAR(100) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, ville VARCHAR(50) DEFAULT NULL, pays VARCHAR(50) NOT NULL, phone VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom_pays VARCHAR(50) NOT NULL, code_pays VARCHAR(20) NOT NULL, code_tel_pays VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfer (id INT AUTO_INCREMENT NOT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, pays_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, montant VARCHAR(255) NOT NULL, taux VARCHAR(50) NOT NULL, fees VARCHAR(50) NOT NULL, taxe VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_4034A3C010335F61 (expediteur_id), INDEX IDX_4034A3C0A4F84F6E (destinataire_id), INDEX IDX_4034A3C0A6E44244 (pays_id), INDEX IDX_4034A3C038248176 (currency_id), INDEX IDX_4034A3C0D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE currency ADD CONSTRAINT FK_6956883FA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE destinataire ADD CONSTRAINT FK_FEA9FF9210335F61 FOREIGN KEY (expediteur_id) REFERENCES expediteur (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C010335F61 FOREIGN KEY (expediteur_id) REFERENCES expediteur (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES destinataire (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C038248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0D725330D');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C038248176');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0A4F84F6E');
        $this->addSql('ALTER TABLE destinataire DROP FOREIGN KEY FK_FEA9FF9210335F61');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C010335F61');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9A6E44244');
        $this->addSql('ALTER TABLE currency DROP FOREIGN KEY FK_6956883FA6E44244');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0A6E44244');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE destinataire');
        $this->addSql('DROP TABLE expediteur');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE transfer');
    }
}
