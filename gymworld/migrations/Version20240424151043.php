<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424151043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        // this up() migration is auto-generated, please modify it to your needs
        /*$this->addSql('CREATE TABLE offre_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, offre_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_A0CE647E19EB6921 (client_id), INDEX IDX_A0CE647E4CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');*/
        $this->addSql('ALTER TABLE offre_client ADD CONSTRAINT FK_OFFRECLIENTS_USER FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_client ADD CONSTRAINT FK_OFFRECLIENTS_OFFRES FOREIGN KEY (offre_id) REFERENCES offres (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_client DROP FOREIGN KEY FK_A0CE647E19EB6921');
        $this->addSql('ALTER TABLE offre_client DROP FOREIGN KEY FK_A0CE647E4CC8505A');
        $this->addSql('DROP TABLE offre_client');
    }
}
