<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Application\Console\CommandInterface;
use Ramsey\Uuid\Uuid;
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
        $io->section('Project ApplicationUri');

        $projectUri = $io->ask('Project ApplicationUri');

        $this->generateBootstrap('application-uri.php', $output);
        \file_put_contents('bootstrap/application-uri.php', "\$applicationUri->setMainUri('{$projectUri}');", FILE_APPEND);
        \rename('bootstrap/application-uri.php', 'bootstrap/local/application-uri.php');

        // asset
        $this->generateConfig('asset', $output);

        $fileContent = \file_get_contents('config/local/asset.config.php');
        $fileContent = \str_replace("'url' => []", "'url' => ['/assets']", $fileContent);
        \file_put_contents('config/local/asset.config.php', $fileContent);

        \symlink('../resources/assets', 'public/assets');

        // media

        \symlink('../data/media', 'public/media');

        //Admin Secret
        $uuid = Uuid::uuid4()->toString();

        $adminContent = <<<EOD
<?php
declare(strict_types=1);

namespace App;

use Ixocreate\Admin\AdminConfigurator;
\$admin->setSecret('{$uuid}');
EOD;


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
            'file' => $file,
        ];

        $commandInput = new ArrayInput($arguments);
        $returnCode = $command->run($commandInput, $output);
    }

    private function generateBootstrap($file, $output)
    {
        $command = $this->getApplication()->find('bootstrap:generate');

        $arguments = [
            'command' => 'bootstrap:generate',
            'file' => $file,
        ];

        $commandInput = new ArrayInput($arguments);
        $returnCode = $command->run($commandInput, $output);
    }
}
