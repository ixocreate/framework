<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Http\ErrorHandling\Factory;

use Ixocreate\Framework\Http\ErrorHandling\Response\NotFoundHandler;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Template\Renderer;
use Zend\Diactoros\Response;

final class NotFoundHandlerFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return NotFoundHandler|mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->has(Renderer::class)
            ? $container->get(Renderer::class)
            : null;

        $template = isset($config['template_404'])
            ? $config['template_404']
            : NotFoundHandler::TEMPLATE_DEFAULT;

        return new NotFoundHandler(
            function () {
                return new Response();
            },
            $renderer,
            $template
        );
    }
}
