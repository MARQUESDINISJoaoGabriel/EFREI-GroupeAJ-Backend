<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107142806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecurie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, moteur VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_B51A9B7E6C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infraction (id INT AUTO_INCREMENT NOT NULL, pilote_id INT DEFAULT NULL, ecurie_id INT DEFAULT NULL, type VARCHAR(20) NOT NULL, montant DOUBLE PRECISION DEFAULT NULL, points INT DEFAULT NULL, date DATETIME NOT NULL, description LONGTEXT NOT NULL, course VARCHAR(100) NOT NULL, INDEX IDX_C1A458F5F510AAE9 (pilote_id), INDEX IDX_C1A458F557F92A74 (ecurie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilote (id INT AUTO_INCREMENT NOT NULL, ecurie_id INT NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, points INT NOT NULL, statut VARCHAR(20) NOT NULL, date_debut_f1 DATE NOT NULL, INDEX IDX_6A3254DD57F92A74 (ecurie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infraction ADD CONSTRAINT FK_C1A458F5F510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilote (id)');
        $this->addSql('ALTER TABLE infraction ADD CONSTRAINT FK_C1A458F557F92A74 FOREIGN KEY (ecurie_id) REFERENCES ecurie (id)');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DD57F92A74 FOREIGN KEY (ecurie_id) REFERENCES ecurie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infraction DROP FOREIGN KEY FK_C1A458F5F510AAE9');
        $this->addSql('ALTER TABLE infraction DROP FOREIGN KEY FK_C1A458F557F92A74');
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DD57F92A74');
        $this->addSql('DROP TABLE ecurie');
        $this->addSql('DROP TABLE infraction');
        $this->addSql('DROP TABLE pilote');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
