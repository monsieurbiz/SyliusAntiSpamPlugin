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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Exception;

use RuntimeException;

final class ExceededPeriodNotFoundException extends RuntimeException
{
    private ?int $level;

    public function __construct(?int $level = null)
    {
        parent::__construct(sprintf('Exceeded period not found for level `%s`', $level));
        $this->level = $level;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }
}
