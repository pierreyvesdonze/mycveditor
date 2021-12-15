<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215105426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2C05F5D32');
        $this->addSql('DROP INDEX IDX_DB0A5ED2C05F5D32 ON education');
        $this->addSql('ALTER TABLE education CHANGE educations_id c_v_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED252B5672F FOREIGN KEY (c_v_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED252B5672F ON education (c_v_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED252B5672F');
        $this->addSql('DROP INDEX IDX_DB0A5ED252B5672F ON education');
        $this->addSql('ALTER TABLE education CHANGE c_v_id educations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2C05F5D32 FOREIGN KEY (educations_id) REFERENCES cv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2C05F5D32 ON education (educations_id)');
    }
}
