<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629122650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memo DROP FOREIGN KEY FK_AB4A902AF65A5046');
        $this->addSql('DROP INDEX IDX_AB4A902AF65A5046 ON memo');
        $this->addSql('ALTER TABLE memo DROP shares_id');
        $this->addSql('ALTER TABLE shares ADD memo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shares ADD CONSTRAINT FK_905F717CB4D32439 FOREIGN KEY (memo_id) REFERENCES memo (id)');
        $this->addSql('CREATE INDEX IDX_905F717CB4D32439 ON shares (memo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memo ADD shares_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE memo ADD CONSTRAINT FK_AB4A902AF65A5046 FOREIGN KEY (shares_id) REFERENCES shares (id)');
        $this->addSql('CREATE INDEX IDX_AB4A902AF65A5046 ON memo (shares_id)');
        $this->addSql('ALTER TABLE shares DROP FOREIGN KEY FK_905F717CB4D32439');
        $this->addSql('DROP INDEX IDX_905F717CB4D32439 ON shares');
        $this->addSql('ALTER TABLE shares DROP memo_id');
    }
}
