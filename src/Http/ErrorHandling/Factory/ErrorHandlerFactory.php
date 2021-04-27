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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Stratigility\Middleware\ErrorHandler;

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
