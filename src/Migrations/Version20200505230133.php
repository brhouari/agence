<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505230133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prprety_option (prprety_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_743F8690C76D7DFD (prprety_id), INDEX IDX_743F8690A7C41D6F (option_id), PRIMARY KEY(prprety_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prprety_option ADD CONSTRAINT FK_743F8690C76D7DFD FOREIGN KEY (prprety_id) REFERENCES prprety (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prprety_option ADD CONSTRAINT FK_743F8690A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prprety_option DROP FOREIGN KEY FK_743F8690A7C41D6F');
        $this->addSql('DROP TABLE prprety_option');
        $this->addSql('DROP TABLE `option`');
    }
}
