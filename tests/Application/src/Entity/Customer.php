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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareTrait;
use Sylius\Component\Core\Model\Customer as SyliusCustomer;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_customer")
 */
class Customer extends SyliusCustomer implements QuarantineItemAwareInterface
{
    use QuarantineItemAwareTrait;
}
