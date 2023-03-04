<?php

namespace PhpRepos\DailyRoutines\Kernel;

class Route
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly string $method,
        public readonly string $endpoint,
    ) {}

    public static function get(string $name, string $url, string $endpoint): static
    {
        return new static($name, $url, 'GET', $endpoint);
    }
}
