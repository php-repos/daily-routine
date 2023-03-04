<?php

namespace PhpRepos\DailyRoutines\Application\Endpoints\WeatherForecast;

use PhpRepos\DailyRoutines\Kernel\IO\Request\Request;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Response;
use PhpRepos\DailyRoutines\Kernel\Drivers\OpenWeatherMapApi\FiveDayThreeHourForecast;

return function (Request $request)
{
    return Response::json(FiveDayThreeHourForecast\get($request->params['latitude'], $request->params['longitude']));
};
