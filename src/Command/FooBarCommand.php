<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FooBarCommand extends Command
{
    protected static $defaultName = 'foo:bar';

    protected function configure()
    {
        $this->setHelp('This command only outputs demo text');
        $this->setDescription('This Foo gets you Bar');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Foo Bar');

        return Command::SUCCESS;
    }
}
