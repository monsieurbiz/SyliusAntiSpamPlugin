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

interface ValidatorsRegistryInterface
{
    /**
     * @param string $code
     * @param ValidatorInterface $validator
     */
    public function addValidator(string $code, ValidatorInterface $validator): void;

    /**
     * @param string $code
     *
     * @return bool
     */
    public function hasValidator(string $code): bool;

    /**
     * @param string $code
     *
     * @return ValidatorInterface|null
     */
    public function getValidator(string $code): ?ValidatorInterface;
}
