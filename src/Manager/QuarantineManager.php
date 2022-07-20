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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Manager;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use Sylius\Component\Core\Model\OrderInterface;

final class QuarantineManager implements QuarantineManagerInterface
{
    private EntityManagerInterface $quarantineItemManager;

    public function __construct(EntityManagerInterface $quarantineItemManager)
    {
        $this->quarantineItemManager = $quarantineItemManager;
    }

    public function liftQuarantineByOrder(OrderInterface $order): void
    {
        $customer = $order->getCustomer();
        if (!$customer instanceof QuarantineItemAwareInterface) {
            return;
        }

        $quarantineItem = $customer->getQuarantineItem();
        if (null === $quarantineItem) {
            return;
        }

        $this->liftQuarantine($quarantineItem);
    }

    private function liftQuarantine(QuarantineItemInterface $quarantineItem): void
    {
        if (!$quarantineItem->isQuarantined()) {
            return;
        }

        $quarantineItem->setLevel(QuarantineItemInterface::LEVEL_LIFTED);
        $quarantineItem->setLiftedAt(new DateTime());

        $this->quarantineItemManager->flush();
    }
}
