<?php
require_once '../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/shows', function($vars) {
        $repository = new \App\Repositories\ShowsRepository();
        $provider = new \App\Providers\ShowsProvider($repository);
        return [
            'response' => array_values($provider->getAllModels())
        ];
    });

    $r->addRoute('GET', '/shows/{showId:\d+}/events', function($vars) {
        $repository = new \App\Repositories\EventsRepository();
        $provider = new \App\Providers\EventsProvider($repository);

        return [
            'response' => array_values($provider->getModelsByShowId((int) $vars['showId']))
        ];
    });

    $r->addRoute('GET', '/events/{eventId:\d+}/places', function($vars) {
        $repository = new \App\Repositories\PlacesRepository();
        $provider = new \App\Providers\PlacesProvider($repository);

        return [
            'response' => array_values($provider->getModelsByEventId((int) $vars['eventId']))
        ];
    });

    $r->addRoute('POST', '/events/{eventId:\d+}/reserve', function($vars) {
        $placesIds = $_POST['places'] ?? [];
        if (empty($placesIds)) {
            return [
                'error' => 'Empty places',
            ];
        }

        $name = $_POST['name'] ?? null;
        if (!$name) {
            return [
                'error' => 'Empty name',
            ];
        }

        $repository = new \App\Repositories\PlacesRepository();
        $provider = new \App\Providers\PlacesProvider($repository);

        /** @var \App\Models\Place[] $places */
        $places = $provider->getModelsByEventId((int) $vars['eventId']);

        foreach ($placesIds as $placeId) {
            if (!isset($places[$placeId])) {
                return [
                    'error' => "Place #{$placeId} not found",
                ];
            }

            /** @var \App\Models\Place $place */
            $place = $places[$placeId];

            if (!$place->isAvailable()) {
                return [
                    'error' => "Place #{$placeId} not available",
                ];
            }
        }

        return [
            'response' => [
                'success' => true,
                'reservation_id' => uniqid(),
            ],
        ];

    });

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        print 404;
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        print 405;
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (!is_callable($handler)) {
            throw new Exception('Error handling');
        }
        header('Content-Type: application/json');
        print json_encode($handler($vars));
        break;
}