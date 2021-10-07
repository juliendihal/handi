<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006145144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interet_user (interet_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_940627F6C1289ECC (interet_id), INDEX IDX_940627F6A76ED395 (user_id), PRIMARY KEY(interet_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE interet_user ADD CONSTRAINT FK_940627F6C1289ECC FOREIGN KEY (interet_id) REFERENCES interet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interet_user ADD CONSTRAINT FK_940627F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE interet_user');
    }
}
