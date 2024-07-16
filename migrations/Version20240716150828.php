<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716150828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, DROP slug, CHANGE uuid uuid VARCHAR(180) NOT NULL, CHANGE role roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_UUID ON user (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_UUID ON user');
        $this->addSql('ALTER TABLE user ADD slug VARCHAR(64) NOT NULL, DROP firstname, CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE roles role JSON NOT NULL');
    }
}
