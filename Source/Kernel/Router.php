<?php

namespace PhpRepos\DailyRoutines\Kernel\Router;

use Closure;
use PhpRepos\DailyRoutines\Kernel\IO\Request\Request;
use PhpRepos\DailyRoutines\Kernel\Route;

function http(Request $request, array $routes): ?Closure
{
    foreach ($routes as $route) {
        /** @var Route $route */
        if ($request->base_url() === $route->url) {
            return include_once $route->endpoint;
        }
    }

    return null;
}
