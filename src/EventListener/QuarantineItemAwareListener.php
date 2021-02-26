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

use Doctrine\Persistence\Event\LifecycleEventArgs;
use MonsieurBiz\SyliusAntiSpamPlugin\Checker\HealthCheckerInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;

final class QuarantineItemAwareListener
{
    /** @var HealthCheckerInterface */
    private HealthCheckerInterface $healthChecker;

    public function __construct(HealthCheckerInterface $healthChecker)
    {
        $this->healthChecker = $healthChecker;
    }

    /**
     * @param LifecycleEventArgs $args
     *
     * @return void
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!$object instanceof QuarantineItemAwareInterface) {
            return;
        }

        $this->healthChecker->check($object);
    }
}
