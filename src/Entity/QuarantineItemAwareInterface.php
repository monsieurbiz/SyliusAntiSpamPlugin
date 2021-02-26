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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Entity;

interface QuarantineItemAwareInterface
{
    /**
     * @return QuarantineItemInterface|null
     */
    public function getQuarantineItem(): ?QuarantineItemInterface;

    /**
     * @param QuarantineItemInterface|null $quarantineItem
     */
    public function setQuarantineItem(?QuarantineItemInterface $quarantineItem): void;

    /**
     * @return string|null
     */
    public function getEmail(): ?string;
}
