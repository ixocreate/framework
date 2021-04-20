<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Application\ApplicationBootstrap;
use Ixocreate\Application\ApplicationConfig;
use Ixocreate\Application\Bootstrap\BootstrapFactory;
use Ixocreate\Application\Console\CommandInterface;
use Ixocreate\Application\Http\HttpApplication;
use Ixocreate\Application\Service\ServiceHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PrepareApplicationConsole extends Command implements CommandInterface
{
    /**
     * @var ApplicationConfig
     */
    private $applicationConfig;

    public function __construct(ApplicationConfig $applicationConfig)
    {
        parent::__construct(self::getCommandName());
        $this->applicationConfig = $applicationConfig;
    }

    public static function getCommandName()
    {
        return 'prepare:application';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new ServiceHandler())->save($this->applicationConfig);

        $application = new HttpApplication('bootstrap');
        (new ApplicationBootstrap())->save('bootstrap', 'resources/generated/application/', $application, new BootstrapFactory(), true);

        return 0;
    }
}
