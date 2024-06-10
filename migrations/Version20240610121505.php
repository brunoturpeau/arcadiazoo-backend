<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610121505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE suggest_feeding (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, user_id INT DEFAULT NULL, feeding VARCHAR(255) DEFAULT NULL, quantity INT DEFAULT NULL, INDEX IDX_A6A77DEB8E962C16 (animal_id), INDEX IDX_A6A77DEBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE suggest_feeding ADD CONSTRAINT FK_A6A77DEB8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE suggest_feeding ADD CONSTRAINT FK_A6A77DEBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suggest_feeding DROP FOREIGN KEY FK_A6A77DEB8E962C16');
        $this->addSql('ALTER TABLE suggest_feeding DROP FOREIGN KEY FK_A6A77DEBA76ED395');
        $this->addSql('DROP TABLE suggest_feeding');
    }
}
