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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Registry;

use MonsieurBiz\SyliusAntiSpamPlugin\Validator\ValidatorInterface;

final class ValidatorsRegistry implements ValidatorsRegistryInterface
{
    private array $validators = [];

    /**
     * {@inheritdoc}
     */
    public function addValidator(ValidatorInterface $validator): void
    {
        $this->validators[] = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidators(): array
    {
        return $this->validators;
    }
}
