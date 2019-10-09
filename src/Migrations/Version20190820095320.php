<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190820095320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_info (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(190) NOT NULL, color VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, titre VARCHAR(190) NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_6F96648912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE informations ADD CONSTRAINT FK_6F96648912469DE2 FOREIGN KEY (category_id) REFERENCES category_info (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE informations DROP FOREIGN KEY FK_6F96648912469DE2');
        $this->addSql('DROP TABLE category_info');
        $this->addSql('DROP TABLE informations');
    }
}
