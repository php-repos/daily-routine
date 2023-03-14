<?php

namespace PhpRepos\DailyRoutines\Kernel\Bootstrap;

use PhpRepos\DailyRoutines\Kernel\Application;
use function PhpRepos\FileManager\Resolver\realpath;
use function PhpRepos\FileManager\Resolver\root;

function boot(): Application
{
    error_log('load routes', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $routes = require_once realpath(root() . '/../Source/Application/Routes.php');
    error_log('create application', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    return new Application(routes: $routes);
}
