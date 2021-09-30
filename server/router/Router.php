<?php

declare(strict_types=1);

namespace Router;

use Exception;
use Router\Exception\RouteNotFound;

class Router implements RouterInterface
{
    private const NO_ROUTE = 404;

    /**
     * @var \ArrayObject<Route>
     */
    private $routes;

    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    /**
     * Router constructor.
     * @param $routes array<Route>
     */
    public function __construct(array $routes = [])
    {
        $this->routes = new \ArrayObject();
        $this->urlGenerator = new UrlGenerator($this->routes);
        foreach ($routes as $route) {
            $this->add($route);
        }
    }

    public function add(Route $route): self
    {
        $this->routes->offsetSet($route->getName(), $route);
        return $this;
    }

    public function matchFromPath(string $path, string $method): Route
    {
        foreach ($this->routes as $route) {
            if ($route->match($path, $method) === false) {
                continue;
            }
            return $route;
        }

        http_response_code(404);
    }

    public function generateUri(string $name, array $parameters = []): string
    {
        return $this->urlGenerator->generate($name, $parameters);
    }

    public function getUrlGenerator(): UrlGenerator
    {
        return $this->urlGenerator;
    }
}