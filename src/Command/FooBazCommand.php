<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'foo:baz',
    description: 'This Foo is for Baz',
    aliases: ['baz:foo'],
    hidden: false,
)]

final class FooBazCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello World');

        return Command::SUCCESS;
    }
}
