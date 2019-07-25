<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719201238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, poll_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_34DCD1763C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_choice (person_id INT NOT NULL, choice_id INT NOT NULL, INDEX IDX_5D0E6A24217BBB47 (person_id), INDEX IDX_5D0E6A24998666D1 (choice_id), PRIMARY KEY(person_id, choice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, poll_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_C1AB5A923C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1763C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('ALTER TABLE person_choice ADD CONSTRAINT FK_5D0E6A24217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_choice ADD CONSTRAINT FK_5D0E6A24998666D1 FOREIGN KEY (choice_id) REFERENCES choice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A923C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person_choice DROP FOREIGN KEY FK_5D0E6A24217BBB47');
        $this->addSql('ALTER TABLE person_choice DROP FOREIGN KEY FK_5D0E6A24998666D1');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1763C947C0F');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A923C947C0F');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_choice');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE poll');
    }
}
