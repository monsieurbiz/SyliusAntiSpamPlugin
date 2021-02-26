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

namespace MonsieurBiz\SyliusAntiSpamPlugin\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;

final class AddValidatorsPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        try {
            $registry = $container->findDefinition('monsieurbiz.anti_spam.validators.registry');
        } catch (InvalidArgumentException $exception) {
            return;
        }

        foreach ($container->getDefinitions() as $id => $definition) {
            if ($definition->hasTag('monsieurbiz_anti_spam.validator')) {
                $registry->addMethodCall('addValidator', [new Reference($id)]);
            }
        }
    }
}
