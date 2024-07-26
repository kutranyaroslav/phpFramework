<?php

namespace User\Framework\http;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        //adding routes
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {

            $routes = include BASE_PATH.'/routes/web.php';
            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        $route_info = $dispatcher->dispatch($request->getMethod(), $request->getPath());

        [$route_status,[$route_controller, $route_method], $route_vars] = $route_info;
        $response = (new $route_controller)->$route_method($route_vars);

        return $response;
    }
}
