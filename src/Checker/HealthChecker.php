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
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Registry\ValidatorsRegistryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class HealthChecker implements HealthCheckerInterface
{
    /**
     * @var ValidatorsRegistryInterface
     */
    private ValidatorsRegistryInterface $validatorsRegistry;

    /**
     * @var FactoryInterface
     */
    private FactoryInterface $quarantineItemFactory;

    /**
     * @param ValidatorsRegistryInterface $validatorsRegistry
     * @param FactoryInterface $quarantineItemFactory
     */
    public function __construct(
        ValidatorsRegistryInterface $validatorsRegistry,
        FactoryInterface $quarantineItemFactory
    ) {
        $this->validatorsRegistry = $validatorsRegistry;
        $this->quarantineItemFactory = $quarantineItemFactory;
    }

    /**
     * @param QuarantineItemAwareInterface $object
     *
     * @return void
     */
    public function check(QuarantineItemAwareInterface $object): void
    {
        $reasonCodes = $this->validate($object);
        if (empty($reasonCodes)) {
            return;
        }

        /** @var QuarantineItemInterface $quarantineItem */
        $quarantineItem = $this->quarantineItemFactory->createNew();
        $quarantineItem->setReasonCodes($reasonCodes);
        $quarantineItem->setEmail($object->getEmail());
        $quarantineItem->setLevel(QuarantineItemInterface::LEVEL_SUSPECTED);
        $object->setQuarantineItem($quarantineItem);
    }

    /**
     * @param QuarantineItemAwareInterface $object
     *
     * @return string[]
     */
    private function validate(QuarantineItemAwareInterface $object): array
    {
        $reasonCodes = [];
        foreach ($this->validatorsRegistry->getValidators() as $validator) {
            if (!$validator->isEligible($object)) {
                continue;
            }
            $reasonCodes = array_merge($reasonCodes, $validator->validate($object));
        }

        return $reasonCodes;
    }
}
