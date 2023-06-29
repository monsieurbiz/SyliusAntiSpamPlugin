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

namespace MonsieurBiz\SyliusAntiSpamPlugin\EventListener;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

final class QuarantineInitializeUpdateListener
{
    private RequestStack $requestStack;

    private UrlGeneratorInterface $urlGenerator;

    public function __construct(
        RequestStack $requestStack,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->requestStack = $requestStack;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke(ResourceControllerEvent $resourceControllerEvent): void
    {
        $this->getFlashBag()->add('error', 'monsieurbiz_anti_spam.resource.update_quarantine_error');
        $resourceControllerEvent->setResponse(
            new RedirectResponse($this->getRedirectUrl())
        );
    }

    private function getRedirectUrl(): string
    {
        $request = $this->requestStack->getMainRequest();
        $referer = $request ? $request->headers->get('referer') : null;

        return $referer ?? $this->urlGenerator->generate('sylius_admin_customer_index');
    }

    private function getFlashBag(): FlashBagInterface
    {
        $request = $this->requestStack->getMainRequest();

        $flashBag = $request?->getSession()->getBag('flashes');

        Assert::isInstanceOf($flashBag, FlashBagInterface::class);

        return $flashBag;
    }
}
