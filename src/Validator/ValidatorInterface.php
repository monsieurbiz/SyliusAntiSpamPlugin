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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Validator;

interface ValidatorInterface
{
    public function isEligible(object $object, array $options = []): bool;

    /**
     * @return array<string>
     */
    public function validate(object $object, array $options = []): array;
}
