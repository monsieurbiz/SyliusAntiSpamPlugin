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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3 as Recaptcha3Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;

final class CustomerRegistrationFormExtension extends AbstractTypeExtension
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('captcha', Recaptcha3Type::class, [
            'mapped' => false,
            'constraints' => [
                new Recaptcha3Constraint(['groups' => 'sylius_user_registration']),
                new Assert\NotBlank(['groups' => 'sylius_user_registration']),
            ],
            'action_name' => 'register',
        ]);
    }

    public static function getExtendedTypes(): array
    {
        return [CustomerRegistrationType::class];
    }
}
