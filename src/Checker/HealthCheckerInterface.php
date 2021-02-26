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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Checker;

use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;

interface HealthCheckerInterface
{
    /**
     * @param QuarantineItemAwareInterface $object
     *
     * @return void
     */
    public function check(QuarantineItemAwareInterface $object): void;
}
