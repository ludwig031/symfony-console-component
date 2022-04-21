<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

final class CreateUserCommand  extends Command
{
    protected static $defaultName = 'user:create';

    protected function configure()
    {
        $this->setDescription('Create User');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questionHelper = $this->getHelper('question');
        $formatter = $this->getHelper('formatter');

        $question = new Question("<question>Please enter the username:</question> ", 'user' . rand());

        $username = $questionHelper->ask($input, $output, $question);

        $question = new Question("<question>Please enter your password:</question> ");
        $question->setValidator(function ($value) {
            if ($value == null || $value == '') {
                throw new \Exception("<error>The password cannot be empty</error>");
            }

            return $value;
        });
        $question->setHidden(true);
        $question->setMaxAttempts(20);

        $password = $questionHelper->ask($input, $output, $question);

        $question = new ChoiceQuestion(
            "<question>Please select gender:</question> ",
            // choices can also be PHP objects that implement __toString() method
            ['F', 'M', 'none'],
            0
        );

        $gender = $questionHelper->ask($input, $output, $question);

        $cities = ['Osijek', 'Zagreb', 'Split', 'Rijeka'];
        $question = new Question("<question>Please enter user city:</question> ", 'Zagreb');
        $question->setAutocompleterValues($cities);

        $city = $questionHelper->ask($input, $output, $question);

        $question = new ConfirmationQuestion("Continue with user creation? [<info>y</info>/<comment>N</comment>] ", false);

        if (!$questionHelper->ask($input, $output, $question)) {
            $errorMessages = ['', 'User not created', ''];
            $style = 'error';
        } else {
            $errorMessages = ['', 'Success!', 'User created', ''];
            $style = 'info';
        }

        $formattedBlock = $formatter->formatBlock($errorMessages, $style);
        $output->writeln($formattedBlock);

        if ($output->isVerbose()) {
            $table = new Table($output);
            $table
                ->setHeaders(['Key', 'Value'])
                ->setRows([
                    ['username', $username],
                    ['gender', $gender],
                    ['city', $city],
                ]);
            $table->render();
        }

        return Command::SUCCESS;
    }
}
