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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226114003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item DROP FOREIGN KEY FK_278E03F59395C3F3');
        $this->addSql('DROP INDEX UNIQ_278E03F59395C3F3 ON monsieurbiz_anti_spam_quarantine_item');
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item DROP customer_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item ADD CONSTRAINT FK_278E03F59395C3F3 FOREIGN KEY (customer_id) REFERENCES sylius_customer (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_278E03F59395C3F3 ON monsieurbiz_anti_spam_quarantine_item (customer_id)');
    }
}
