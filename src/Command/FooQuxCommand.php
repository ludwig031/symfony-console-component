<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FooQuxCommand extends Command
{
    protected function configure()
    {
        $this->setHelp('This command only outputs demo text');
        $this->setDescription('I\'ll Qux, you Foo');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello World');

        return Command::SUCCESS;
    }
}
