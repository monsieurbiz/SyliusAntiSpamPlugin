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

trait QuarantineItemAwareTrait
{
    /**
     * @ORM\OneToOne(targetEntity="MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface", fetch="LAZY", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="quarantine_item_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    #[ORM\OneToOne(targetEntity: 'MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface', fetch: 'LAZY', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'quarantine_item_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    protected ?QuarantineItemInterface $quarantineItem = null;

    public function getQuarantineItem(): ?QuarantineItemInterface
    {
        return $this->quarantineItem;
    }

    public function setQuarantineItem(?QuarantineItemInterface $quarantineItem): void
    {
        $this->quarantineItem = $quarantineItem;
    }
}
