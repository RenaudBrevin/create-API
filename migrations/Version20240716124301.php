<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716124301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E9F3D07E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A1EB02C0');
        $this->addSql('DROP INDEX IDX_F5299398A1EB02C0 ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398E9F3D07E ON `order`');
        $this->addSql('ALTER TABLE `order` DROP waiter_id, DROP barman_id');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, DROP role, DROP slug');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD waiter_id INT DEFAULT NULL, ADD barman_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E9F3D07E FOREIGN KEY (waiter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A1EB02C0 FOREIGN KEY (barman_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A1EB02C0 ON `order` (barman_id)');
        $this->addSql('CREATE INDEX IDX_F5299398E9F3D07E ON `order` (waiter_id)');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_USERNAME ON user');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL, ADD slug VARCHAR(64) NOT NULL, DROP username, DROP roles');
    }
}
