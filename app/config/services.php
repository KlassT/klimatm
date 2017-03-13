<?php

use Phalcon\Loader;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Crypt;


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view) {
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);
    $volt->setOptions([
        'compiledPath' => BASE_PATH . '/cache/volt/',
        'compiledSeparator' => '_'
    ]);

    $compiler = $volt->getCompiler();
    $compiler->addFilter('price', function($resolvedArgs, $exprArgs) {
        return "$resolvedArgs . ' руб'";
    });
    $compiler->addFilter('diff', function($resolvedArgs, $exprArgs) {
        return "\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $resolvedArgs)->diffForHumans()";
    });
    $compiler->addFilter('substr', function($resolvedArgs, $exprArgs) {
        return "substr($resolvedArgs, 0, 255)";
    });

    return $volt;
});

$di->set(
    "crypt",
    function () {
        $crypt = new Crypt();

        $crypt->setKey('#3fe12$=adg?.we//f4y$'); // Используйте свой собственный ключ!

        return $crypt;
    }
);
