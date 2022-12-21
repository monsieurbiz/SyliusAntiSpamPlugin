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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Validator;

use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator as Recaptcha3ValidatorConstraints;
use ReCaptcha\Response as RecaptchaResponse;
use Symfony\Component\HttpFoundation\RequestStack;

final class ReCaptcha3Validator implements ValidatorInterface
{
    public const CAPTCHA_MINIMUM_SCORE = 0.8;

    private Recaptcha3ValidatorConstraints $recaptcha3ValidatorConstraint;

    private RequestStack $requestStack;

    private bool $karserRecaptcha3Enabled;

    private array $routesToCheck;

    public function __construct(
        RequestStack $requestStack,
        Recaptcha3ValidatorConstraints $recaptcha3ValidatorConstraint,
        bool $karserRecaptcha3Enabled,
        array $routesToCheck
    ) {
        $this->requestStack = $requestStack;
        $this->recaptcha3ValidatorConstraint = $recaptcha3ValidatorConstraint;
        $this->karserRecaptcha3Enabled = $karserRecaptcha3Enabled;
        $this->routesToCheck = $routesToCheck;
    }

    /**
     * Avoid to enable captcha verification in command, fixtures and request without capacha field (like guest checkout).
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function isEligible(object $object, array $options = []): bool
    {
        $mainRequest = $this->requestStack->getMainRequest();
        $isRouteEligible = $mainRequest && \in_array($mainRequest->attributes->get('_route'), $this->routesToCheck, true);

        return $this->karserRecaptcha3Enabled && $isRouteEligible;
    }

    /**
     * @inheritdoc
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function validate(object $object, array $options = []): array
    {
        $errors = [];

        $lastResponse = $this->recaptcha3ValidatorConstraint->getLastResponse();
        if (!$lastResponse instanceof RecaptchaResponse) {
            $errors[] = 'monsieurbiz_anti_spam.error.missing_captcha_reponse';
        } elseif ($lastResponse->getScore() < self::CAPTCHA_MINIMUM_SCORE) {
            $errors[] = 'monsieurbiz_anti_spam.error.invalid_captcha_score';
        }

        return $errors;
    }
}
