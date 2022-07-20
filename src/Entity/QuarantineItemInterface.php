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

use DateTimeInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface QuarantineItemInterface extends ResourceInterface, TimestampableInterface
{
    public const LEVEL_LIFTED = 0;

    public const LEVEL_PROVEN = 16;

    public const LEVEL_LIKELY = 8;

    public const LEVEL_SUSPECTED = 4;

    /**
     * @return string[]|null
     */
    public function getReasonCodes(): ?array;

    /**
     * @param string[]|null $reasonCodes
     */
    public function setReasonCodes(?array $reasonCodes): void;

    public function getLevel(): ?int;

    public function setLevel(?int $level): void;

    public function getEmail(): ?string;

    public function setEmail(?string $email): void;

    public function getLiftedAt(): ?DateTimeInterface;

    public function setLiftedAt(?DateTimeInterface $liftedAt): void;

    public function isQuarantined(?int $level = null): bool;
}
