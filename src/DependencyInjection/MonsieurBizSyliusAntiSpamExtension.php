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

use MonsieurBiz\SyliusAntiSpamPlugin\Validator\ValidatorInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class MonsieurBizSyliusAntiSpamExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->registerForAutoconfiguration(ValidatorInterface::class)
            ->addTag('monsieurbiz_anti_spam.validator')
        ;

        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('monsieurbiz.anti_spam.quarantine_item_exceeded_period.suspected', $config['exceeded']['suspected']);
        $container->setParameter('monsieurbiz.anti_spam.quarantine_item_exceeded_period.likely', $config['exceeded']['likely']);
        $container->setParameter('monsieurbiz.anti_spam.quarantine_item_exceeded_period.proven', $config['exceeded']['proven']);
    }

    /**
     * @inheritdoc
     */
    public function getAlias(): string
    {
        return str_replace('monsieur_biz', 'monsieurbiz', parent::getAlias());
    }
}
