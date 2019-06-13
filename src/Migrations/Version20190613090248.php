<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613090248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD id_user_id INT DEFAULT NULL, ADD author VARCHAR(255) NOT NULL, ADD editor VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD date_added DATETIME NOT NULL, ADD integral TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6679F37AE5 ON article (id_user_id)');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD gender VARCHAR(255) NOT NULL, ADD payment_method VARCHAR(255) NOT NULL, ADD user_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6679F37AE5');
        $this->addSql('DROP INDEX IDX_23A0E6679F37AE5 ON article');
        $this->addSql('ALTER TABLE article DROP id_user_id, DROP author, DROP editor, DROP state, DROP date_added, DROP integral');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP city, DROP country, DROP gender, DROP payment_method, DROP user_name');
    }
}
