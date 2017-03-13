<?php

namespace App\Backend;

use App\Navigation;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use App\Backend\Plugins\SecurityPlugin;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'App\Backend\Controllers' => __DIR__ . '/controllers/',
            'App\Backend\Models'      => __DIR__ . '/models/',
            'App\Backend\Plugins'      => __DIR__ . '/plugins/',
            'App\Backend\Forms'      => __DIR__ . '/forms/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });

        $di->set('navigation', new Navigation());

        $dispatcher = $di->get('dispatcher');
        $eventsManager = new EventsManager;
        $eventsManager->attach('dispatch', new SecurityPlugin);
        $dispatcher->setEventsManager($eventsManager);
        $di->set('dispatcher', $dispatcher);

        $url = $di->get('url');
        $url->setBaseUri('/admin/');
        $di->set('url', $url);
    }
}
