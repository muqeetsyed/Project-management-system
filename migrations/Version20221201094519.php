<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201094521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<SQL
                CREATE TABLE employee (
                    id INT AUTO_INCREMENT NOT NULL,
                    code INT NOT NULL,
                    firstname VARCHAR(100) NOT NULL,
                    middlename VARCHAR(100) DEFAULT NULL,
                    lastname VARCHAR(100) DEFAULT NULL,
                    gender VARCHAR(50) NOT NULL,
                    department VARCHAR(100) NOT NULL,
                    position VARCHAR(50) DEFAULT NULL,
                    email VARCHAR(250) NOT NULL,
                    password VARCHAR(250) NOT NULL,
                    avatar VARCHAR(250) DEFAULT NULL,
                    status VARCHAR(20) NOT NULL,
                    PRIMARY KEY(id)
                )
                DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employees');
    }
}
