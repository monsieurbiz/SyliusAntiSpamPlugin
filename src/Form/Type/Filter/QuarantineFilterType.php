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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Form\Type\Filter;

use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class QuarantineFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => [
                    'monsieurbiz_anti_spam.ui.suspected' => QuarantineItemInterface::LEVEL_SUSPECTED,
                    'monsieurbiz_anti_spam.ui.proven' => QuarantineItemInterface::LEVEL_PROVEN,
                    'monsieurbiz_anti_spam.ui.likely' => QuarantineItemInterface::LEVEL_LIKELY,
                ],
                'data_class' => null,
                'required' => false,
                'placeholder' => 'sylius.ui.all',
            ])
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'monsieurbiz_anti_spam_grid_filter_quarantine';
    }
}
