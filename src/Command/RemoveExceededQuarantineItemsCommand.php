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

namespace MonsieurBiz\SyliusAntiSpamPlugin\Command;

use MonsieurBiz\SyliusAntiSpamPlugin\Remover\ExceededQuarantineItemsRemoverInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RemoveExceededQuarantineItemsCommand extends Command
{
    protected static $defaultName = 'monsieurbiz:anti-spam:remove-exceeded-quarantine-items';

    private ExceededQuarantineItemsRemoverInterface $exceededQuarantineItemsRemover;

    public function __construct(
        ExceededQuarantineItemsRemoverInterface $exceededQuarantineItemsRemover,
        string $name = null
    ) {
        parent::__construct($name);
        $this->exceededQuarantineItemsRemover = $exceededQuarantineItemsRemover;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameters)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->exceededQuarantineItemsRemover->remove();

        return 0; // TODO o be replaced by Command::SUCCESS when the supported sylius version is higher than 1.12.
    }
}
