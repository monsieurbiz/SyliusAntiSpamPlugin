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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('monsieurbiz_sylius_anti_spam');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        $this->addExpirationPeriodsSection($rootNode);

        return $treeBuilder;
    }

    private function addExpirationPeriodsSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('exceeded')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('suspected')->defaultValue('1 year')->cannotBeEmpty()->end()
                        ->scalarNode('likely')->defaultValue('182 days')->cannotBeEmpty()->end()
                        ->scalarNode('proven')->defaultValue('90 days')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
