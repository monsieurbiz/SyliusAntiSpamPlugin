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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Remover;

use DateTime;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Exception\ExceededPeriodNotFoundException;
use Sylius\Component\Registry\ServiceRegistryInterface;

final class ExceededQuarantineItemsRemover implements ExceededQuarantineItemsRemoverInterface
{
    private ServiceRegistryInterface $quarantineableRegistry;

    private EntityManagerInterface $entityManager;

    private array $expirationPeriodsByLevel;

    private array $terminalDatesByLevel = [];

    public function __construct(
        ServiceRegistryInterface $quarantineableRegistry,
        EntityManagerInterface $entityManager,
        array $expirationPeriodsByLevel
    ) {
        $this->quarantineableRegistry = $quarantineableRegistry;
        $this->entityManager = $entityManager;
        $this->expirationPeriodsByLevel = $expirationPeriodsByLevel;
    }

    public function remove(): void
    {
        // Loop on all quarantinable entities to check if we have to clean it
        foreach ($this->quarantineableRegistry->all() as $quarantineableEntity) {
            if (!$quarantineableEntity instanceof QuarantineItemAwareInterface) {
                continue;
            }

            $this->removeByEntityClass($quarantineableEntity);
        }
    }

    private function removeByEntityClass(QuarantineItemAwareInterface $quarantineableEntity): void
    {
        $repository = $this->entityManager->getRepository($quarantineableEntity::class);
        // Retrieve entities with an associated Quarantine Item
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('quarantineItem', null));
        $quarantineEntities = $repository->matching($criteria);

        /** @var QuarantineItemAwareInterface $quarantineEntity */
        foreach ($quarantineEntities as $quarantineEntity) {
            $this->removeQuarantineEntity($quarantineEntity);
        }

        $this->entityManager->flush();
    }

    private function removeQuarantineEntity(QuarantineItemAwareInterface $quarantineEntity): void
    {
        $quarantineItem = $quarantineEntity->getQuarantineItem();
        if (null === $quarantineItem || !$quarantineItem->isQuarantined()) {
            return;
        }

        if ($this->canRemoveEntity($quarantineItem)) {
            // TODO before delete entity check if this can be remove (for example customer has no order)
            // Use a registry with CanRemove classes (isEligible and canRemove methods for example)

            $this->entityManager->remove($quarantineEntity);
        }
    }

    private function canRemoveEntity(QuarantineItemInterface $quarantineItem): bool
    {
        try {
            $terminalDate = $this->getTerminalDateByLevel($quarantineItem->getLevel());
        } catch (ExceededPeriodNotFoundException $e) {
            // not date found for this level
            return false;
        }

        return $terminalDate > $quarantineItem->getCreatedAt();
    }

    /**
     * @throws Exception
     */
    private function getTerminalDateByLevel(?int $level): DateTime
    {
        $terminalDates = $this->getTerminalDates();
        if (null === $level || !\array_key_exists($level, $terminalDates)) {
            throw new ExceededPeriodNotFoundException();
        }

        return $terminalDates[$level];
    }

    private function getTerminalDates(): array
    {
        if (!$this->terminalDatesByLevel) {
            foreach ($this->expirationPeriodsByLevel as $level => $expirationPeriod) {
                $this->terminalDatesByLevel[$level] = new DateTime('-' . $expirationPeriod);
            }
        }

        return $this->terminalDatesByLevel;
    }
}
