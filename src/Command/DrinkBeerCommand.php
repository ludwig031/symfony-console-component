<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DrinkBeerCommand extends Command
{
    protected static $defaultName = 'beer:drink';

    protected function configure()
    {
        $this->setDescription('Get ready for a beer');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rows = 10;
        $progressBar = new ProgressBar($output, $rows);
        $progressBar->setBarCharacter('<fg=magenta>=</>');
        $progressBar->setProgressCharacter("\xF0\x9F\x8D\xBA");

        $progressBar->start();

        for ($i = 0; $i<$rows; $i++) {
            usleep(300000);
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');

        return Command::SUCCESS;
    }
}
