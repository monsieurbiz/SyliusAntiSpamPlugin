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

use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3 as Recaptcha3Constraint;
use Sylius\Bundle\CoreBundle\Form\Type\ContactType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class ContactFormExtension extends AbstractTypeExtension
{
    private bool $karserRecaptcha3Enabled;

    public function __construct(bool $karserRecaptcha3Enabled)
    {
        $this->karserRecaptcha3Enabled = $karserRecaptcha3Enabled;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $constraints = [
            new Recaptcha3Constraint(),
        ];
        if ($this->karserRecaptcha3Enabled) {
            $constraints[] = new Assert\NotBlank();
        }

        $builder->add('captcha', Recaptcha3Type::class, [
            'mapped' => false,
            'constraints' => $constraints,
            'action_name' => 'contact',
        ]);
    }

    public static function getExtendedTypes(): array
    {
        return [ContactType::class];
    }
}
