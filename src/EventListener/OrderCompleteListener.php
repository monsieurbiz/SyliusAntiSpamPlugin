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

namespace MonsieurBiz\SyliusAntiSpamPlugin\EventListener;

use MonsieurBiz\SyliusAntiSpamPlugin\Manager\QuarantineManagerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class OrderCompleteListener
{
    private QuarantineManagerInterface $quarantineManager;

    public function __construct(QuarantineManagerInterface $quarantineManager)
    {
        $this->quarantineManager = $quarantineManager;
    }

    public function liftQuarantine(GenericEvent $event): void
    {
        $order = $event->getSubject();
        Assert::isInstanceOf($order, OrderInterface::class);

        $this->quarantineManager->liftQuarantineByOrder($order);
    }
}
