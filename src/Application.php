<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Event\EventManagerInterface;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\RoutingMiddleware;

/**
 * Application setup class.
 *
 * See defines the bootstrapping logic and middleware layers for the Headless API.
 *
 * @extends \Cake\Http\BaseApplication<\App\Application>
 */
class Application extends BaseApplication
{
    /**
     * Load all the application configuration and bootstrap logic.
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        // By default, does not allow fallback classes.
        /** @var \Cake\Datasource\Locator\LocatorInterface<\Cake\Datasource\RepositoryInterface> $tableLocator */
        $tableLocator = (new TableLocator())->allowFallbackClass(false);
        FactoryLocator::add('Table', $tableLocator);
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * Optimized for Headless API: removed CSRF, Asset, and HostHeader middleware.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions and return as JSON (via ErrorController)
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Add routing middleware.
            ->add(new RoutingMiddleware($this))

            /**
             * Parse JSON request bodies so they are available through $request->getData()
             * Hädavajalik Next.js-iga suhtlemiseks.
             */
            ->add(new BodyParserMiddleware());

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     */
    public function services(ContainerInterface $container): void
    {
        // Dependency injection configuration if needed.
    }

    /**
     * Register custom event listeners.
     */
    public function events(EventManagerInterface $eventManager): EventManagerInterface
    {
        return $eventManager;
    }
}
