<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupConsole extends Command implements CommandInterface
{
    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    public static function getCommandName()
    {
        return 'setup';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // database
        $io->section('Database');

        $database = $io->ask('Database Name');
        $user = $io->ask('Username', 'root');
        $password = $io->ask('Password', '');
        $host = $io->ask('Host', '127.0.0.1');

        $this->generateConfig('database', $output);

        $fileContent = \file_get_contents('config/local/database.config.php');
        $fileContent = \preg_replace("/'dbname' => '[a-z0-9_-]*'/i", "'dbname' => '{$database}'", $fileContent);
        $fileContent = \preg_replace("/'user' => '[a-z0-9_-]*'/i", "'user' => '{$user}'", $fileContent);
        $fileContent = \preg_replace("/'password' => '[a-z0-9_-]*'/i", "'password' => '{$password}'", $fileContent);
        $fileContent = \preg_replace("/'host' => '[a-z0-9_-]*'/i", "'host' => '{$host}'", $fileContent);
        \file_put_contents('config/local/database.config.php', $fileContent);

        // project uri
        $io->section('Project Uri');

        $projectUri = $io->ask('Project Uri');

        $this->generateBootstrap('project-uri.php', $output);
        \file_put_contents('bootstrap/project-uri.php', "\$projectUri->setMainUri('{$projectUri}');", FILE_APPEND);

        // asset

        $io->section('Assets');

        $assetUri = $io->ask('Asset Uri', 'assets');

        $this->generateConfig('asset', $output);

        $fileContent = \file_get_contents('config/local/asset.config.php');
        $fileContent = \str_replace("'url' => []", "'url' => ['{$assetUri}']", $fileContent);
        \file_put_contents('config/local/asset.config.php', $fileContent);


        $confirm = $io->confirm('Create Symlink?', true);
        if ($confirm) {
            \symlink('../resources/assets', 'public/assets');
        }

        // media

        $io->section('Media');

        $mediaUri = $io->ask('Media Uri', 'media');

        $this->generateConfig('media', $output);

        $fileContent = \file_get_contents('config/local/media.config.php');
        $fileContent = \str_replace("'uri' => ''", "'uri' => '{$mediaUri}'", $fileContent);
        \file_put_contents('config/local/media.config.php', $fileContent);

        $confirm = $io->confirm('Create Symlink?', true);
        if ($confirm) {
            \symlink('../data/media', 'public/media');
        }

        // end

        $io->text([
            '<info>Setup complete</info>',
            '',
            'Next you should run:',
        ]);
        $io->listing([
            './ixocreate migration:migrate',
            './ixocreate admin:create-user',
        ]);
    }

    private function generateConfig($file, $output)
    {
        $command = $this->getApplication()->find('config:generate');

        $arguments = [
            'command' => 'config:generate',
            'file'    => $file,
        ];

        $commandInput = new ArrayInput($arguments);
        $returnCode = $command->run($commandInput, $output);
    }

    private function generateBootstrap($file, $output)
    {
        $command = $this->getApplication()->find('bootstrap:generate');

        $arguments = [
            'command' => 'bootstrap:generate',
            'file'    => $file,
        ];

        $commandInput = new ArrayInput($arguments);
        $returnCode = $command->run($commandInput, $output);
    }
}
