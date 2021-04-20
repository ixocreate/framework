<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Application\Console\CommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PrepareAllConsole extends Command implements CommandInterface
{
    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    public static function getCommandName()
    {
        return 'prepare:all';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $baseCommand = \getcwd() . '/' . \basename($_SERVER['SCRIPT_FILENAME']);

        $this->executeCommand('prepare:application', $baseCommand, $output);
        $this->executeCommand('prepare:servicemanager', $baseCommand, $output);
        $this->executeCommand('prepare:database', $baseCommand, $output);

        return 0;
    }

    private function executeCommand(string $command, string $baseCommand, OutputInterface $output): void
    {
        $process = new Process([PHP_BINARY, $baseCommand, $command, '-d']);
        $process->setTimeout(null);
        $exitCode = $process->run();
        if ($exitCode !== 0) {
            $output->writeln("<error>Error while executing $command</error>");
            $output->writeln($process->getOutput());
            $output->writeln($process->getErrorOutput());
        }
    }
}
