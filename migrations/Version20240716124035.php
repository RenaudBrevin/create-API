<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716124035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_drink DROP FOREIGN KEY FK_8E20342C8D9F6D38');
        $this->addSql('ALTER TABLE order_drink DROP FOREIGN KEY FK_8E20342C36AA4BB4');
        $this->addSql('DROP TABLE order_drink');
        $this->addSql('ALTER TABLE `order` ADD waiter_id INT DEFAULT NULL, ADD barman_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E9F3D07E FOREIGN KEY (waiter_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A1EB02C0 FOREIGN KEY (barman_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F5299398E9F3D07E ON `order` (waiter_id)');
        $this->addSql('CREATE INDEX IDX_F5299398A1EB02C0 ON `order` (barman_id)');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_USERNAME ON user');
        $this->addSql('ALTER TABLE user ADD slug VARCHAR(64) NOT NULL, DROP username, DROP roles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_drink (order_id INT NOT NULL, drink_id INT NOT NULL, INDEX IDX_8E20342C36AA4BB4 (drink_id), INDEX IDX_8E20342C8D9F6D38 (order_id), PRIMARY KEY(order_id, drink_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_drink ADD CONSTRAINT FK_8E20342C8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_drink ADD CONSTRAINT FK_8E20342C36AA4BB4 FOREIGN KEY (drink_id) REFERENCES drink (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E9F3D07E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A1EB02C0');
        $this->addSql('DROP INDEX IDX_F5299398E9F3D07E ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398A1EB02C0 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP waiter_id, DROP barman_id');
        $this->addSql('ALTER TABLE `user` ADD username VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, DROP slug');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON `user` (username)');
    }
}
