<?php
namespace App\Frontend;

use App\Frontend\Plugins\SecurityPlugin;
use App\Cart;
use App\User;
use App\Navigation;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

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
            'App\Frontend\Controllers' => __DIR__ . '/controllers/',
            'App\Frontend\Models' => __DIR__ . '/models/',
            'App\Frontend\Plugins' => __DIR__ . '/plugins/',
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

        $dispatcher = $di->get('dispatcher');
        $eventsManager = new EventsManager;
        $eventsManager->attach('dispatch', new SecurityPlugin());
        $dispatcher->setEventsManager($eventsManager);
        $di->set('dispatcher', $dispatcher);

        $di->set('user', new User());
        $di->set('cart', new Cart());
        $di->set('navigation', new Navigation());
    }
}
