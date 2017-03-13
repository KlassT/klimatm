<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'App\Models' => APP_PATH . '/common/models/',
    'App'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'App\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'App\Backend\Module' => APP_PATH . '/modules/backend/Module.php',
    'App\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
