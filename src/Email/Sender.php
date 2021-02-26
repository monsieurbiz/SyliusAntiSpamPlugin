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

use MonsieurBiz\SyliusAntiSpamPlugin\Repository\QuarantineItemRepositoryInterface;
use Sylius\Component\Mailer\Sender\SenderInterface;

final class Sender implements SenderInterface
{
    /**
     * @var SenderInterface
     */
    private SenderInterface $inner;

    /**
     * @var QuarantineItemRepositoryInterface
     */
    private QuarantineItemRepositoryInterface $quarantineItemRepository;

    /**
     * Sender constructor.
     *
     * @param SenderInterface $inner
     * @param QuarantineItemRepositoryInterface $quarantineItemRepository
     */
    public function __construct(SenderInterface $inner, QuarantineItemRepositoryInterface $quarantineItemRepository)
    {
        $this->inner = $inner;
        $this->quarantineItemRepository = $quarantineItemRepository;
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
        $quarantineItems = $this->quarantineItemRepository->findAllByEmails($recipients);
        foreach ($quarantineItems as $quarantineItem) {
            if ($quarantineItem->isQuarantined()) {
                $index = array_search($quarantineItem->getEmail(), $recipients, true);
                unset($recipients[$index]);
            }
        }
        if (!empty($recipients)) {
            $this->inner->send($code, $recipients, $data, $attachments, $replyTo);
        }
    }
}
