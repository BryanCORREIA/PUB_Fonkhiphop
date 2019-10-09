<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190821123150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jours (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, jour_id INT DEFAULT NULL, heure_deb TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_FDCA8C9C7A45358C (groupe_id), INDEX IDX_FDCA8C9C220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annulation (id INT AUTO_INCREMENT NOT NULL, cour_id INT DEFAULT NULL, date_annulation DATE NOT NULL, INDEX IDX_26F7D84B7942F03 (cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, age_min INT NOT NULL, age_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C220C6AD0 FOREIGN KEY (jour_id) REFERENCES jours (id)');
        $this->addSql('ALTER TABLE annulation ADD CONSTRAINT FK_26F7D84B7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64939194ABF');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64939194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id)');
        $this->addSql('ALTER TABLE informations DROP FOREIGN KEY FK_6F96648912469DE2');
        $this->addSql('ALTER TABLE informations ADD CONSTRAINT FK_6F96648912469DE2 FOREIGN KEY (category_id) REFERENCES category_info (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C220C6AD0');
        $this->addSql('ALTER TABLE annulation DROP FOREIGN KEY FK_26F7D84B7942F03');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C7A45358C');
        $this->addSql('DROP TABLE jours');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE annulation');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('ALTER TABLE informations DROP FOREIGN KEY FK_6F96648912469DE2');
        $this->addSql('ALTER TABLE informations ADD CONSTRAINT FK_6F96648912469DE2 FOREIGN KEY (category_id) REFERENCES category_info (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64939194ABF');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64939194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id) ON DELETE CASCADE');
    }
}
