<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240401091507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX uniq_genre_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_genres (user_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_A70C6B86A76ED395 (user_id), INDEX IDX_A70C6B864296D31F (genre_id), PRIMARY KEY(user_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_genres ADD CONSTRAINT FK_A70C6B86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_genres ADD CONSTRAINT FK_A70C6B864296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument CHANGE instrument_type_id instrument_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD is_conductor TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_genres DROP FOREIGN KEY FK_A70C6B86A76ED395');
        $this->addSql('ALTER TABLE users_genres DROP FOREIGN KEY FK_A70C6B864296D31F');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE users_genres');
        $this->addSql('ALTER TABLE user DROP is_conductor');
        $this->addSql('ALTER TABLE instrument CHANGE instrument_type_id instrument_type_id INT DEFAULT NULL');
    }
}
