<?php

namespace User\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use User\Framework\http\exceptions\MethodNotAllowedException;
use User\Framework\http\exceptions\RouteNotFoundException;
use User\Framework\http\Request;

use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request)
    {
        // TODO: Implement dispatch() method.

        [$route_handler, $route_vars] = $this->extractRouteInfo($request);

        if (is_array($route_handler)) {
            [$route_controller, $route_method] = $route_handler;
            $route_handler = [new $route_controller, $route_method];
        }

        return [$route_handler, $route_vars];
    }

    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {

            $routes = include BASE_PATH.'/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        $route_info = $dispatcher->dispatch($request->getMethod(), $request->getPath());

        //return of $route-info [$route_status,[$route_controller, $route_method], $route_vars] = $route_info;
        switch ($route_info[0]) {
            case Dispatcher::FOUND:
                return [$route_info[1], $route_info[2]];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $route_info[1]);
                throw new MethodNotAllowedException("Supported HTTP methods: $allowedMethods");
            default:
                throw new RouteNotFoundException('Route not found ');
        }
    }
}
