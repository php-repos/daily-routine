<?php

namespace PhpRepos\DailyRoutines\Kernel;

class Application
{
    public function __construct(
        public readonly array $envs = [],
        public readonly array $routes = [],
        public readonly array $commands = [],
    ) {}
}
