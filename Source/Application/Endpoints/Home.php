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
    $user = system_user();
    $date = date('l, F j, Y');
    $hard_status = HardStatus\get();
    $ram_status = RamStatus\get();
    $cryptos = getenv('COINMARKETCAP_API_KEY') ? LatestListing\get() : null;
    $headlines = getenv('NEWSAPI_API_KEY') ? Headlines\get() : null;
    $show_weather = getenv('OPENWEATHERMAP_API_KEY');
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