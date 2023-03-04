<?php

namespace PhpRepos\DailyRoutines\Kernel\Bootstrap;

use PhpRepos\DailyRoutines\Kernel\Application;
use function PhpRepos\FileManager\Resolver\realpath;
use function PhpRepos\FileManager\Resolver\root;

function boot(): Application
{
    $routes = require_once realpath(root() . '/../Source/Application/Routes.php');

    return new Application(routes: $routes);
}
