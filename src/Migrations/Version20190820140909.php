<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190820140909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(190) NOT NULL, description LONGTEXT NOT NULL, nbr_pers INT NOT NULL, age_min INT NOT NULL, age_max INT NOT NULL, privated TINYINT(1) NOT NULL, style_danse VARCHAR(190) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(190) NOT NULL, cp VARCHAR(5) NOT NULL, prix NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (stage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_716970922298D193 (stage_id), INDEX IDX_71697092A76ED395 (user_id), PRIMARY KEY(stage_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_716970922298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE informations DROP FOREIGN KEY FK_6F96648912469DE2');
        $this->addSql('ALTER TABLE informations ADD CONSTRAINT FK_6F96648912469DE2 FOREIGN KEY (category_id) REFERENCES category_info (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_716970922298D193');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE participants');
        $this->addSql('ALTER TABLE informations DROP FOREIGN KEY FK_6F96648912469DE2');
        $this->addSql('ALTER TABLE informations ADD CONSTRAINT FK_6F96648912469DE2 FOREIGN KEY (category_id) REFERENCES category_info (id) ON DELETE CASCADE');
    }
}
