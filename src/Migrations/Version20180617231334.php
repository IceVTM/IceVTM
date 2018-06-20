<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180617231334 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $firstUser = $this->connection->createQueryBuilder()
            ->select('id')
            ->from('user')
            ->orderBy('id', 'ASC')
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        $tokens = $this->connection->createQueryBuilder()
            ->select('driver_token')
            ->from('taken_job')
            ->execute();

        $this->addSql('CREATE TABLE driver_token (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DFB56C165F37A13B (token), INDEX IDX_DFB56C16A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE driver_token ADD CONSTRAINT FK_DFB56C16A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');

        foreach ($tokens as $token) {
            $this->addSql(
                'INSERT INTO driver_token (user_id, token, created_at) VALUES (:user_id, :token, :created_at)',
                [
                    'user_id' => $firstUser['id'],
                    'token' => $token['driver_token'],
                    'created_at' => $this->connection->convertToDatabaseValue(new \DateTime(), 'datetime')
                ]
            );
        }

        $this->addSql('ALTER TABLE taken_job CHANGE driver_token driver_token_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE taken_job ADD CONSTRAINT FK_377A4F96CA97985 FOREIGN KEY (driver_token_id) REFERENCES driver_token (token)');
        $this->addSql('CREATE INDEX IDX_377A4F96CA97985 ON taken_job (driver_token_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('UPDATE user SET created_at = ?', [$this->connection->convertToDatabaseValue(new \DateTime(), 'datetime')]);
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taken_job DROP FOREIGN KEY FK_377A4F96CA97985');
        $this->addSql('DROP TABLE driver_token');
        $this->addSql('DROP INDEX IDX_377A4F96CA97985 ON taken_job');
        $this->addSql('ALTER TABLE taken_job CHANGE driver_token_id driver_token VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
