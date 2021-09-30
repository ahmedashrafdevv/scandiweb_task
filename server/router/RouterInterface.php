<?php

declare(strict_types=1);

namespace Router;


interface RouterInterface
{
    public function matchFromPath(string $path, string $method): Route;

    /**
     * @param string $name
     * @param array $parameters
     * @return string
     * @throws \InvalidArgumentException if unable to generate the given URI.
     */
    public function generateUri(string $name, array $parameters = []): string;
}