<?php
namespace KiwiSuite\Framework;
/** @var ResourceConfigurator $resource */
use KiwiSuite\Resource\SubManager\ResourceConfigurator;

$resource->addDirectory(getcwd() . '/src/Admin/Resource', true);
$resource->addDirectory(getcwd() . '/src/App/Resource', true);
