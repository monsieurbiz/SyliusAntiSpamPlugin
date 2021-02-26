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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

final class QuarantineItemRepository extends EntityRepository implements QuarantineItemRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAllByEmails(array $emails): array
    {
        return (array) $this->findBy([
            'email' => $emails,
        ]);
    }
}
