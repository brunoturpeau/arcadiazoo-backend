<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521130514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, breed_id_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, health VARCHAR(128) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6AAB231F243B1A1A (breed_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, detail LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, animal_id_id INT DEFAULT NULL, habitat_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C53D045F5EB747A3 (animal_id_id), INDEX IDX_C53D045F20AE7A39 (habitat_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, animal_id_id INT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', detail LONGTEXT NOT NULL, INDEX IDX_C42F77849D86650F (user_id_id), INDEX IDX_C42F77845EB747A3 (animal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F243B1A1A FOREIGN KEY (breed_id_id) REFERENCES breed (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F20AE7A39 FOREIGN KEY (habitat_id_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77845EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F243B1A1A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F5EB747A3');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F20AE7A39');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849D86650F');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77845EB747A3');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE report');
    }
}
