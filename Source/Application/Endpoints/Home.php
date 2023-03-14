<?php

namespace PhpRepos\DailyRoutines\Http\Endpoints\Home;

use PhpRepos\DailyRoutines\Kernel\Drivers\CoinMarketCapApi\LatestListing;
use PhpRepos\DailyRoutines\Kernel\Drivers\NewsApi\Headlines;
use PhpRepos\DailyRoutines\Kernel\Drivers\System\HardStatus;
use PhpRepos\DailyRoutines\Kernel\Drivers\System\RamStatus;
use PhpRepos\DailyRoutines\Kernel\IO\Request\Request;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Response;
use PhpRepos\DailyRoutines\Kernel\UI\Html;
use function PhpRepos\DailyRoutines\Kernel\UserManagement\Authentication\system_user;

return function (Request $request): Response
{
    error_log('endpoint received the request', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    error_log('find user', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $user = system_user();
    error_log('user is ' . $user . ' get date', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $date = date('l, F j, Y');
    error_log('get hard status', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $hard_status = HardStatus\get();
    error_log('get ram status', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $ram_status = RamStatus\get();
    error_log('get crypto list', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $cryptos = getenv('COINMARKETCAP_API_KEY') && strlen(getenv('COINMARKETCAP_API_KEY')) > 0 ? LatestListing\get() : null;
    error_log('get headlines', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $headlines = getenv('NEWSAPI_API_KEY') && strlen(getenv('NEWSAPI_API_KEY')) > 0 ? Headlines\get() : null;
    error_log('get weather', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $show_weather = getenv('OPENWEATHERMAP_API_KEY') && strlen(getenv('OPENWEATHERMAP_API_KEY')) > 0;
    error_log('create view', 3, \PhpRepos\FileManager\Resolver\root() . '/logs.txt');
    $html = Html\view(
        filename: 'home',
        variables: compact(
        'user',
        'date',
            'hard_status',
            'ram_status',
            'cryptos',
            'headlines',
            'show_weather',
        )
    );

    return Response::html($html);
};