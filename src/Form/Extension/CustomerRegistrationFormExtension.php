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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Form\Extension;

use Huluti\AltchaBundle\Type\AltchaType;
use Huluti\AltchaBundle\Validator\Altcha;
use Huluti\AltchaBundle\Validator\AltchaSentinel;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3 as Recaptcha3Constraint;
use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerRegistrationFormExtension extends AbstractTypeExtension
{
    public function __construct(
        private bool $karserRecaptcha3Enabled,
        private bool $altchaEnabled,
        private bool $useAltchaSentinel,
        private array $validationGroups,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addRecaptcha($builder);
        $this->addAltcha($builder);
    }

    private function addRecaptcha(FormBuilderInterface $builder): void
    {
        if (!$this->karserRecaptcha3Enabled) {
            return;
        }

        $constraints = [
            new Recaptcha3Constraint([
                'groups' => 'sylius_user_registration',
                'message' => 'monsieurbiz_anti_spam_plugin.recaptcha3.invalid',
                'messageMissingValue' => 'monsieurbiz_anti_spam_plugin.recaptcha3.empty',
            ]),
        ];

        $builder->add('captcha', Recaptcha3Type::class, [
            'mapped' => false,
            'constraints' => $constraints,
            'action_name' => 'register',
        ]);
    }

    private function addAltcha(FormBuilderInterface $builder): void
    {
        if (!$this->altchaEnabled) {
            return;
        }

        $builder->add('altcha', AltchaType::class, [
            'label' => false,
            'hide_logo' => true,
            'hide_footer' => true,
            'constraints' => $this->useAltchaSentinel ? new AltchaSentinel(groups: $this->validationGroups) : new Altcha(groups: $this->validationGroups),
        ]);
    }

    public static function getExtendedTypes(): array
    {
        return [CustomerRegistrationType::class];
    }
}
