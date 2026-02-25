<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/**
 * Routes configuration.
 *
 * Siin määrame, kuidas URL-id vastavad kontrolleritele.
 * Oleme eemaldanud kõik HTML-põhised PagesControlleri viited.
 */
return function (RouteBuilder $routes): void {
    
    // Kasutame DashedRoute klassi (nt /api/blog-posts)
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Kuna juur-aadress (/) ei oma Headless API puhul sisu,
         * suuname selle näiteks tervitustekstile.
         * Selleks peame hiljem looma ApiControlleri.
         */
        $builder->connect('/', ['controller' => 'Api', 'action' => 'index']);

        /*
         * Lubame automaatsed marsruudid kontrolleritele.
         * See on kasulik arenduse algfaasis.
         */
        $builder->fallbacks();
    });

    /**
     * API skoop. 
     * Siia alla koondame kõik tulevased ressursid (posts, users jne).
     */
    $routes->scope('/api', function (RouteBuilder $builder): void {
        // Sunnime JSON laienduse käsitlust (valikuline, kuna AppController juba teeb seda)
        $builder->setExtensions(['json']);

        // Näidis: $builder->resources('Posts');
        
        $builder->fallbacks();
    });
};