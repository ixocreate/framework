<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Framework\Console;

use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\ProxyFactory;
use Ixocreate\Application\ApplicationConfig;
use Ixocreate\Application\Console\CommandInterface;;
use Ixocreate\Package\Database\Connection\Factory\ConnectionSubManager;
use Ixocreate\Package\Database\ORM\Mapping\EntityMapper;
use Ixocreate\Package\Database\Repository\EntityRepositoryMapping;
use Ixocreate\Package\Database\Repository\Factory\DoctrineRepositoryFactory;
use Ixocreate\Package\Database\Repository\Factory\RepositorySubManager;
use Ixocreate\Package\Database\Type\Generator\FileWriter;
use Ixocreate\Package\Database\Type\TypeConfig;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabasePrepareConsole extends Command implements CommandInterface
{
    /**
     * @var ApplicationConfig
     */
    private $applicationConfig;

    /**
     * @var TypeConfig
     */
    private $typeConfig;

    /**
     * @var ConnectionSubManager
     */
    private $connectionSubManager;

    /**
     * @var RepositorySubManager
     */
    private $repositorySubManager;

    /**
     * @var EntityRepositoryMapping
     */
    private $entityRepositoryMapping;

    public function __construct(
        ApplicationConfig $applicationConfig,
        TypeConfig $typeConfig,
        ConnectionSubManager $connectionSubManager,
        RepositorySubManager $repositorySubManager,
        EntityRepositoryMapping $entityRepositoryMapping
    ) {
        parent::__construct(self::getCommandName());
        $this->applicationConfig = $applicationConfig;
        $this->typeConfig = $typeConfig;
        $this->connectionSubManager = $connectionSubManager;
        $this->repositorySubManager = $repositorySubManager;
        $this->entityRepositoryMapping = $entityRepositoryMapping;
    }

    public static function getCommandName()
    {
        return 'prepare:database';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new FileWriter())->write(
            \rtrim($this->applicationConfig->getPersistCacheDirectory(), '/'),
            $this->typeConfig
        );

        foreach ($this->connectionSubManager->getServices() as $service) {
            $connection = $this->connectionSubManager->get($service);

            $configuration = new Configuration();
            $configuration->setMetadataDriverImpl(
                new EntityMapper($this->repositorySubManager, $this->entityRepositoryMapping)
            );

            $configuration->setRepositoryFactory(
                new DoctrineRepositoryFactory($this->repositorySubManager, $this->entityRepositoryMapping)
            );

            $configuration->setProxyDir(\sys_get_temp_dir());
            $configuration->setProxyNamespace('Ixocreate\DoctrineProxy');
            $configuration->setMetadataCacheImpl(new PhpFileCache(
                $this->applicationConfig->getPersistCacheDirectory() . 'database/doctrine_metadata'
            ));
            $configuration->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_NEVER);

            $entityManager = EntityManager::create(
                $connection,
                $configuration
            );

            $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();

            foreach ($metadatas as $metadata) {
            }
        }
    }
}
