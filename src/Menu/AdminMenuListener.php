<?php

/*
 * This file is part of Monsieur Biz' Anti Spam plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusAntiSpamPlugin\Menu;

use Knp\Menu\Util\MenuManipulator;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    /**
     * @var MenuManipulator
     */
    private MenuManipulator $manipulator;

    /**
     * AdminMenuListener constructor.
     *
     * @param MenuManipulator $manipulator
     */
    public function __construct(MenuManipulator $manipulator)
    {
        $this->manipulator = $manipulator;
    }

    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        if (null !== ($customersMenu = $menu->getChild('customers'))) {
            $menuItem = $customersMenu->addChild('monsieurbiz_anti_spam', [
                'route' => 'monsieurbiz_anti_spam_admin_quarantine_item_index',
                'label' => 'monsieurbiz_anti_spam.ui.quarantine',
            ]);
            $menuItem->setLabelAttribute('icon', 'medkit');
            $this->manipulator->moveChildToPosition($customersMenu, $menuItem, 100);
        }
    }
}
