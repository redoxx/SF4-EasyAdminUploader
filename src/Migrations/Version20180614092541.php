<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614092541 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign DROP codes');
        $this->addSql('ALTER TABLE codes_csv_file ADD campaign_id INT NOT NULL');
        $this->addSql('ALTER TABLE codes_csv_file ADD CONSTRAINT FK_FBC1334BF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('CREATE INDEX IDX_FBC1334BF639F774 ON codes_csv_file (campaign_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign ADD codes VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE codes_csv_file DROP FOREIGN KEY FK_FBC1334BF639F774');
        $this->addSql('DROP INDEX IDX_FBC1334BF639F774 ON codes_csv_file');
        $this->addSql('ALTER TABLE codes_csv_file DROP campaign_id');
    }
}
