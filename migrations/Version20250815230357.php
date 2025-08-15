<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250815230357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, place_id INT DEFAULT NULL, destination_id INT DEFAULT NULL, logistic_provider_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight DOUBLE PRECISION NOT NULL, volumen DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F5299398DA6A219 (place_id), INDEX IDX_F5299398816C6140 (destination_id), INDEX IDX_F5299398B45E988 (logistic_provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398816C6140 FOREIGN KEY (destination_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B45E988 FOREIGN KEY (logistic_provider_id) REFERENCES logistic_provider (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DA6A219');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398816C6140');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B45E988');
        $this->addSql('DROP TABLE `order`');
    }
}
