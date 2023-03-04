<?php

use PhpRepos\DailyRoutines\Kernel\Route;
use function PhpRepos\FileManager\Resolver\realpath;

return [
    Route::get('index', '', realpath(__DIR__ . '/Endpoints/Home.php')),
    Route::get('home', '/', realpath(__DIR__ . '/Endpoints/Home.php')),
    Route::get('weather-forecast', '/weather', realpath(__DIR__ . '/Endpoints/WeatherForecast.php')),
];
