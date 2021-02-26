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

use Sylius\Component\Resource\Model\TimestampableTrait;

class QuarantineItem implements QuarantineItemInterface
{
    use TimestampableTrait;

    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string[]|null
     */
    private ?array $reasonCodes = null;

    /**
     * @var int|null
     */
    private ?int $level = null;

    /**
     * @var string|null
     */
    private ?string $email = null;

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonCodes(): ?array
    {
        return $this->reasonCodes;
    }

    /**
     * {@inheritdoc}
     */
    public function setReasonCodes(?array $reasonCodes): void
    {
        $this->reasonCodes = $reasonCodes;
    }

    /**
     * {@inheritdoc}
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * {@inheritdoc}
     */
    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}
