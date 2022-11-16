<?php

/*
 * This file is part of Monsieur Biz' Anti Spam plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116163320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_customer ADD quarantine_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_customer ADD CONSTRAINT FK_7E82D5E6DB058ED5 FOREIGN KEY (quarantine_item_id) REFERENCES monsieurbiz_anti_spam_quarantine_item (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E82D5E6DB058ED5 ON sylius_customer (quarantine_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_customer DROP FOREIGN KEY FK_7E82D5E6DB058ED5');
        $this->addSql('DROP INDEX UNIQ_7E82D5E6DB058ED5 ON sylius_customer');
        $this->addSql('ALTER TABLE sylius_customer DROP quarantine_item_id');
    }
}
