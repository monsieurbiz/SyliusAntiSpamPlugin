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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Form\Type;

use DateTime;
use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

final class UpdateQuarantineType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameters)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('liftedAt', DateTimeType::class)
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                /** @var QuarantineItemInterface $quarantineItem */
                $quarantineItem = $event->getData();

                // Update liftedAt only if the level is lifted
                if (QuarantineItemInterface::LEVEL_LIFTED !== $quarantineItem->getLevel()) {
                    return;
                }

                $archivedAt = null;
                if (null === $quarantineItem->getLiftedAt()) {
                    $archivedAt = new DateTime();
                }
                $quarantineItem->setLiftedAt($archivedAt);

                $event->setData($quarantineItem);
            })
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'monsieurbiz_anti_spam_update_quarantine';
    }
}
