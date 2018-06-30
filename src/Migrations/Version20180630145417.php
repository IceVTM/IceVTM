<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180630145417 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $tokens = $this->connection->createQueryBuilder()
            ->select('t.driver_token_id, d.id')
            ->from('taken_job', 't')
            ->leftJoin('t', 'driver_token', 'd', 'd.token = t.driver_token_id')
            ->execute();


        $this->addSql('ALTER TABLE taken_job DROP FOREIGN KEY FK_377A4F96CA97985');

        foreach ($tokens as $token) {
            $this->addSql(
                'UPDATE taken_job SET driver_token_id = :new WHERE driver_token_id = :old',
                [
                    'new' => $token['id'],
                    'old' => $token['driver_token_id'],
                ]
            );
        }

        $this->addSql('ALTER TABLE taken_job CHANGE driver_token_id driver_token_id INT NOT NULL');
        $this->addSql('ALTER TABLE taken_job ADD CONSTRAINT FK_377A4F96CA97985 FOREIGN KEY (driver_token_id) REFERENCES driver_token (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $tokens = $this->connection->createQueryBuilder()
            ->select('t.driver_token_id, d.token')
            ->from('driver_token', 'd')
            ->innerJoin('d', 'taken_job', 't', 'd.id = t.driver_token_id')
            ->execute();

        $this->addSql('ALTER TABLE taken_job DROP FOREIGN KEY FK_377A4F96CA97985');
        $this->addSql('ALTER TABLE taken_job CHANGE driver_token_id driver_token_id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');

        foreach ($tokens as $token) {
            $this->addSql(
                'UPDATE taken_job SET driver_token_id = :new WHERE driver_token_id = :old',
                [
                    'new' => $token['token'],
                    'old' => $token['driver_token_id'],
                ]
            );
        }

        $this->addSql('ALTER TABLE taken_job ADD CONSTRAINT FK_377A4F96CA97985 FOREIGN KEY (driver_token_id) REFERENCES driver_token (token)');
    }
}
