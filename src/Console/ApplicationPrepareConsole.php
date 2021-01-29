<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Console;

use Ixocreate\Application\ApplicationConfig;
use Ixocreate\Application\Console\CommandInterface;
use Ixocreate\Application\Service\ServiceHandler;
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

        return 0;
    }
}
