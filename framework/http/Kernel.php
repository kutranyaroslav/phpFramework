<?php

namespace User\Framework\http;

use User\Framework\http\exceptions\HttpException;
use User\Framework\Routing\RouterInterface;

class Kernel
{
    public function __construct(private RouterInterface $router) {}

    public function handle(Request $request): Response
    {
        //adding routes
        try {
            [$route_handler, $route_vars] = $this->router->dispatch($request);
            $response = call_user_func_array($route_handler, $route_vars);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Throwable $e) {
            $response = new Response($e->getMessage(), $e->getCode());
        }

        return $response;
    }
}
