<?php

declare(strict_types=1);

namespace ZgPHP\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class HelloWorldCommand extends Command
{
    protected static $defaultName = 'hello:world';

    protected function configure()
    {
        $this->setDescription('Outputs "Hello World"');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello World');

        return 0;
    }
}
