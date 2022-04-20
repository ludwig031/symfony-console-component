<?php

declare(strict_types=1);

namespace App\Command;

use App\Value\Lipsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class VariableNameGeneratorCommand extends Command
{
    protected static $defaultName = 'generate:variable';

    private array $validCases = ['camel', 'snake', 'kebab'];

    protected function configure()
    {
        $this->setDescription('Generate variable names');
        $this->addArgument('word-count', InputArgument::REQUIRED, 'Word count');
        $this->addArgument('variable-count', InputArgument::OPTIONAL, 'Variable count');
        $this->addOption('case', 'c', InputOption::VALUE_OPTIONAL, 'Change case', 'camel');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $wordCount = $input->getArgument('word-count');
        if (!is_numeric($wordCount)) {
            $output->writeln('Word count must be numeric!');

            return Command::INVALID;
        }

        $variableCount = $input->getArgument('variable-count');
        if (!is_numeric($variableCount)) {
            $variableCount = 1;
        }

        $case = $input->getOption('case');
        if (!in_array($case, $this->validCases)) {
            $case = 'camel';
        }

        $lipsum = new Lipsum();

        $output->writeln('Here are some variables:');
        $output->writeln('');
        
        for ($i = 0; $i < $variableCount; $i++) {
            $words = $lipsum->getWords($wordCount);
            $output->writeln($this->formatCase($words, $case));
        }

        return Command::SUCCESS;
    }

    private function formatCase(array $words, string $case): string
    {
        $formattedVariable = '';
        if ($case === 'snake') {
            foreach ($words as $key => $word) {
                if ($key !== 0) {
                    $formattedVariable = $formattedVariable . '_' . $word;
                } else {
                    $formattedVariable = $word;
                }
            }
        } elseif ($case === 'kebab') {
            foreach ($words as $key => $word) {
                if ($key !== 0) {
                    $formattedVariable = $formattedVariable . '-' . $word;
                } else {
                    $formattedVariable = $word;
                }
            }
        } else {
            foreach ($words as $key => $word) {
                if ($key !== 0) {
                    $word = ucfirst($word);
                }
                $formattedVariable = $formattedVariable . $word;
            }
        }

        return $formattedVariable;
    }
}
