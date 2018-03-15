<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Resource\ResourceConfigurator;

/** @var ResourceConfigurator $resource */
$resource->addDirectory(getcwd() . '/src/Admin/Resource', true);
