<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424182706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_client DROP INDEX UNIQ_A0CE647E4CC8505A, ADD INDEX IDX_A0CE647E4CC8505A (offre_id)');
        $this->addSql('ALTER TABLE offre_client DROP INDEX UNIQ_A0CE647E19EB6921, ADD INDEX IDX_A0CE647E19EB6921 (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_client DROP INDEX IDX_A0CE647E19EB6921, ADD UNIQUE INDEX UNIQ_A0CE647E19EB6921 (client_id)');
        $this->addSql('ALTER TABLE offre_client DROP INDEX IDX_A0CE647E4CC8505A, ADD UNIQUE INDEX UNIQ_A0CE647E4CC8505A (offre_id)');
    }
}
