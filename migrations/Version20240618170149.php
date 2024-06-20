<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618170149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, image_id INT NOT NULL, title VARCHAR(255) NOT NULL, text VARCHAR(1200) NOT NULL, place VARCHAR(255) NOT NULL, date_from DATETIME NOT NULL, date_to DATETIME NOT NULL, UNIQUE INDEX UNIQ_3BAE0AA73DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, alergens VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_day (id INT AUTO_INCREMENT NOT NULL, breakfast_id INT DEFAULT NULL, snack1_id INT DEFAULT NULL, lunch_id INT DEFAULT NULL, snack2_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_12C7C92D442D22 (breakfast_id), UNIQUE INDEX UNIQ_12C7C92D7692A628 (snack1_id), UNIQUE INDEX UNIQ_12C7C92DD7C83568 (lunch_id), UNIQUE INDEX UNIQ_12C7C92D642709C6 (snack2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_week (id INT AUTO_INCREMENT NOT NULL, monday_id INT DEFAULT NULL, tuesday_id INT DEFAULT NULL, wednesday_id INT DEFAULT NULL, thursday_id INT DEFAULT NULL, friday_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', monday_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_EE7DC11121671777 (monday_id), UNIQUE INDEX UNIQ_EE7DC1115B974FE2 (tuesday_id), UNIQUE INDEX UNIQ_EE7DC111BBA2EEBE (wednesday_id), UNIQUE INDEX UNIQ_EE7DC111D68DEE5D (thursday_id), UNIQUE INDEX UNIQ_EE7DC111812B93DE (friday_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, title_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', happened_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_visible TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_472B783AA9F87BD (title_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_image (gallery_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_21A0D47C4E7AF8F (gallery_id), INDEX IDX_21A0D47C3DA5256D (image_id), PRIMARY KEY(gallery_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, image_id INT NOT NULL, title_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_51CE6E863DA5256D (image_id), UNIQUE INDEX UNIQ_51CE6E86A9F87BD (title_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', position INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, nick VARCHAR(255) NOT NULL, review_text LONGTEXT NOT NULL, stars NUMERIC(2, 1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, description_id INT NOT NULL, image_id INT NOT NULL, name VARCHAR(255) NOT NULL, oder INT DEFAULT NULL, UNIQUE INDEX UNIQ_B0F6A6D5DD842E46 (position_id), UNIQUE INDEX UNIQ_B0F6A6D5D9F966B (description_id), UNIQUE INDEX UNIQ_B0F6A6D53DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translation (id INT AUTO_INCREMENT NOT NULL, sk VARCHAR(5000) NOT NULL, en VARCHAR(5000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA73DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE food_day ADD CONSTRAINT FK_12C7C92D442D22 FOREIGN KEY (breakfast_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE food_day ADD CONSTRAINT FK_12C7C92D7692A628 FOREIGN KEY (snack1_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE food_day ADD CONSTRAINT FK_12C7C92DD7C83568 FOREIGN KEY (lunch_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE food_day ADD CONSTRAINT FK_12C7C92D642709C6 FOREIGN KEY (snack2_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE food_week ADD CONSTRAINT FK_EE7DC11121671777 FOREIGN KEY (monday_id) REFERENCES food_day (id)');
        $this->addSql('ALTER TABLE food_week ADD CONSTRAINT FK_EE7DC1115B974FE2 FOREIGN KEY (tuesday_id) REFERENCES food_day (id)');
        $this->addSql('ALTER TABLE food_week ADD CONSTRAINT FK_EE7DC111BBA2EEBE FOREIGN KEY (wednesday_id) REFERENCES food_day (id)');
        $this->addSql('ALTER TABLE food_week ADD CONSTRAINT FK_EE7DC111D68DEE5D FOREIGN KEY (thursday_id) REFERENCES food_day (id)');
        $this->addSql('ALTER TABLE food_week ADD CONSTRAINT FK_EE7DC111812B93DE FOREIGN KEY (friday_id) REFERENCES food_day (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AA9F87BD FOREIGN KEY (title_id) REFERENCES translation (id)');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E863DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A9F87BD FOREIGN KEY (title_id) REFERENCES translation (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5DD842E46 FOREIGN KEY (position_id) REFERENCES translation (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5D9F966B FOREIGN KEY (description_id) REFERENCES translation (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D53DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA73DA5256D');
        $this->addSql('ALTER TABLE food_day DROP FOREIGN KEY FK_12C7C92D442D22');
        $this->addSql('ALTER TABLE food_day DROP FOREIGN KEY FK_12C7C92D7692A628');
        $this->addSql('ALTER TABLE food_day DROP FOREIGN KEY FK_12C7C92DD7C83568');
        $this->addSql('ALTER TABLE food_day DROP FOREIGN KEY FK_12C7C92D642709C6');
        $this->addSql('ALTER TABLE food_week DROP FOREIGN KEY FK_EE7DC11121671777');
        $this->addSql('ALTER TABLE food_week DROP FOREIGN KEY FK_EE7DC1115B974FE2');
        $this->addSql('ALTER TABLE food_week DROP FOREIGN KEY FK_EE7DC111BBA2EEBE');
        $this->addSql('ALTER TABLE food_week DROP FOREIGN KEY FK_EE7DC111D68DEE5D');
        $this->addSql('ALTER TABLE food_week DROP FOREIGN KEY FK_EE7DC111812B93DE');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AA9F87BD');
        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C4E7AF8F');
        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C3DA5256D');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E863DA5256D');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86A9F87BD');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5DD842E46');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5D9F966B');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D53DA5256D');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_day');
        $this->addSql('DROP TABLE food_week');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE gallery_image');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE translation');
        $this->addSql('DROP TABLE `user`');
    }
}
