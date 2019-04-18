<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Package\Console;

use Ixocreate\Application\ApplicationConfig;
use Ixocreate\Application\ServiceHandler;
use Ixocreate\Application\Console\CommandInterface;;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApplicationPrepareConsole extends Command implements CommandInterface
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
    }
}
