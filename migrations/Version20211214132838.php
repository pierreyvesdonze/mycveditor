<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214132838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience ADD c_v_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10352B5672F FOREIGN KEY (c_v_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_590C10352B5672F ON experience (c_v_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10352B5672F');
        $this->addSql('DROP INDEX IDX_590C10352B5672F ON experience');
        $this->addSql('ALTER TABLE experience DROP c_v_id');
    }
}
