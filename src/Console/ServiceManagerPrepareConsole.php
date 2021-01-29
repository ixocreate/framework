<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Application\Console\CommandInterface;
use Ixocreate\ServiceManager\Generator\AutowireFactoryGenerator;
use Ixocreate\ServiceManager\Generator\LazyLoadingFileGenerator;
use Ixocreate\ServiceManager\ServiceManager;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceManagerPrepareConsole extends Command implements CommandInterface
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;

    public function __construct(ServiceManagerInterface $serviceManager)
    {
        parent::__construct(self::getCommandName());
        $this->serviceManager = $serviceManager;
    }

    public static function getCommandName()
    {
        return 'prepare:servicemanager';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new LazyLoadingFileGenerator())->generate($this->serviceManager);

        (new AutowireFactoryGenerator())->generate($this->serviceManager);

        return 0;
    }
}
