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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Repository;

use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface QuarantineItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @return QuarantineItemInterface[]
     */
    public function findAllByEmails(array $emails): array;
}
