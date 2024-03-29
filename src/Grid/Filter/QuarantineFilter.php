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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;

final class QuarantineFilter implements FilterInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameters)
     *
     * @param mixed $data
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (empty($data)) {
            return;
        }

        $expressions = [
            $dataSource->getExpressionBuilder()->isNotNull('quarantineItem'),
            $dataSource->getExpressionBuilder()->equals('quarantineItem.level', $data),
            $dataSource->getExpressionBuilder()->isNull('quarantineItem.liftedAt'),
        ];
        $dataSource->restrict($dataSource->getExpressionBuilder()->andX(...$expressions));
    }
}
