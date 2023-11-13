<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework\Http\ErrorHandling\Factory;

use Ixocreate\Framework\Http\ErrorHandling\Response\ErrorResponseGenerator;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Laminas\Diactoros\Response;
use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ErrorHandlerFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return mixed|ErrorHandler
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $generator = $container->has(ErrorResponseGenerator::class)
            ? function (
                \Throwable $e,
                ServerRequestInterface $request,
                ResponseInterface $response
            ) use ($container) {
                // wrap for lazy loading
                $generator = $container->get(ErrorResponseGenerator::class);

                if($container->get(ApplicationConfig::class)->isLogErrors()) {
                    \error_log(\sprintf("%s: %s in %s:%d\nStack trace:\n%s", \get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()));
                }

                return $generator($e, $request, $response);
            }
        : null;

        return new ErrorHandler(
            function () {
                return new Response();
            },
            $generator
        );
    }
}
