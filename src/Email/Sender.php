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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Email;

use Sylius\Component\Mailer\Sender\SenderInterface;

final class Sender implements SenderInterface
{
    /**
     * @var SenderInterface
     */
    private SenderInterface $inner;

    /**
     * Sender constructor.
     *
     * @param SenderInterface $inner
     */
    public function __construct(SenderInterface $inner)
    {
        $this->inner = $inner;
    }

    /**
     * @param string $code
     * @param array $recipients
     * @param array $data
     * @param array $attachments
     * @param array $replyTo
     */
    public function send(string $code, array $recipients, array $data = [], array $attachments = [], array $replyTo = []): void
    {
        $this->inner->send($code, $recipients, $data, $attachments, $replyTo);
    }
}
