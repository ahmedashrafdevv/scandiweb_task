<?php

declare(strict_types=1);

namespace Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    /**
     * @param ServerRequestInterface $serverRequest
     * @return Route
     * @throws Exception if no found route.
     */
    public function match(ServerRequestInterface $serverRequest): Route;

    /**
     * @param string $path
     * @param string $method
     * @return Route
     * @throws Exception if no found route.
     */
    public function matchFromPath(string $path, string $method): Route;

    /**
     * @param string $name
     * @param array $parameters
     * @return string
     * @throws \InvalidArgumentException if unable to generate the given URI.
     */
    public function generateUri(string $name, array $parameters = []): string;
}