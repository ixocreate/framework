<?php
namespace Ixocreate\Framework;
/** @var ResourceConfigurator $resource */
use Ixocreate\Resource\SubManager\ResourceConfigurator;

$resource->addDirectory(getcwd() . '/src/Admin/Resource', true);
$resource->addDirectory(getcwd() . '/src/App/Resource', true);
