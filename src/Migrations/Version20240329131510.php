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

final class Version20240329131510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change json_array(deprecated) to json type';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item CHANGE reason_codes reason_codes JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE monsieurbiz_anti_spam_quarantine_item CHANGE reason_codes reason_codes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\'');
    }
}
