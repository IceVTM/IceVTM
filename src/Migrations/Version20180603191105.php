<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180603191105 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE taken_job (id INT AUTO_INCREMENT NOT NULL, driver_token VARCHAR(255) NOT NULL, added_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, game VARCHAR(255) NOT NULL, pickup_city VARCHAR(255) NOT NULL, destination_city VARCHAR(255) NOT NULL, estimated_income VARCHAR(255) NOT NULL, cargo VARCHAR(255) NOT NULL, pickup_company VARCHAR(255) NOT NULL, destination_company VARCHAR(255) NOT NULL, deadline_time DATETIME NOT NULL, trailer_wear DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE taken_job');
    }
}
