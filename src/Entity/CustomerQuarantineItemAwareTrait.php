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

use Doctrine\ORM\Mapping as ORM;

trait CustomerQuarantineItemAwareTrait
{
    /**
     * @ORM\OneToOne(targetEntity="\MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface", mappedBy="customer")
     *
     * @var QuarantineItemInterface|null
     */
    protected ?QuarantineItemInterface $quarantineItem = null;

    /**
     * @return QuarantineItemInterface|null
     */
    public function getQuarantineItem(): ?QuarantineItemInterface
    {
        return $this->quarantineItem;
    }

    /**
     * @param QuarantineItemInterface|null $quarantineItem
     */
    public function setQuarantineItem(?QuarantineItemInterface $quarantineItem): void
    {
        $this->quarantineItem = $quarantineItem;
    }
}
