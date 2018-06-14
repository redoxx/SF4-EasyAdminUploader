<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614095706 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE codes_csv_file ADD nbr_lines_processed INT DEFAULT NULL, DROP nbr_lines, CHANGE processed processed TINYINT(1) DEFAULT NULL, CHANGE start_process_at start_process_at DATETIME DEFAULT NULL, CHANGE end_process_at end_process_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE codes_csv_file ADD nbr_lines VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP nbr_lines_processed, CHANGE processed processed TINYINT(1) NOT NULL, CHANGE start_process_at start_process_at DATETIME NOT NULL, CHANGE end_process_at end_process_at DATETIME NOT NULL');
    }
}
