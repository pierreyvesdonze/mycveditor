<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214132639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(64) NOT NULL, adresse_street VARCHAR(255) NOT NULL, adresse_number_street VARCHAR(255) NOT NULL, adresse_postal_code INT NOT NULL, adresse_town VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_B66FFE92A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, educations_id INT DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, school_name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, school_link VARCHAR(255) DEFAULT NULL, INDEX IDX_DB0A5ED2C05F5D32 (educations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE NOT NULL, town VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_line (id INT AUTO_INCREMENT NOT NULL, experience_id INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_85047BEB46E90E27 (experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interest (id INT AUTO_INCREMENT NOT NULL, c_v_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_6C3E1A6752B5672F (c_v_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, c_v_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_5E3DE47752B5672F (c_v_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2C05F5D32 FOREIGN KEY (educations_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE experience_line ADD CONSTRAINT FK_85047BEB46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE interest ADD CONSTRAINT FK_6C3E1A6752B5672F FOREIGN KEY (c_v_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47752B5672F FOREIGN KEY (c_v_id) REFERENCES cv (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2C05F5D32');
        $this->addSql('ALTER TABLE interest DROP FOREIGN KEY FK_6C3E1A6752B5672F');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47752B5672F');
        $this->addSql('ALTER TABLE experience_line DROP FOREIGN KEY FK_85047BEB46E90E27');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_line');
        $this->addSql('DROP TABLE interest');
        $this->addSql('DROP TABLE skill');
    }
}
