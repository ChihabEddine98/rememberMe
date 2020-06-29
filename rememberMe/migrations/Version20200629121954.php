<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629121954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shares (id INT AUTO_INCREMENT NOT NULL, dest_id INT DEFAULT NULL, src_id INT NOT NULL, INDEX IDX_905F717C79839897 (dest_id), INDEX IDX_905F717CFF529AC (src_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shares ADD CONSTRAINT FK_905F717C79839897 FOREIGN KEY (dest_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE shares ADD CONSTRAINT FK_905F717CFF529AC FOREIGN KEY (src_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE memo ADD yes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE memo ADD CONSTRAINT FK_AB4A902A2CB716C7 FOREIGN KEY (yes_id) REFERENCES shares (id)');
        $this->addSql('CREATE INDEX IDX_AB4A902A2CB716C7 ON memo (yes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memo DROP FOREIGN KEY FK_AB4A902A2CB716C7');
        $this->addSql('DROP TABLE shares');
        $this->addSql('DROP INDEX IDX_AB4A902A2CB716C7 ON memo');
        $this->addSql('ALTER TABLE memo DROP yes_id');
    }
}
