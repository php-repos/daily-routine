<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\OpenWeatherMapApi\FiveDayThreeHourForecast;

function get($latitude, $longitude)
{
    $api_key = getenv('OPENWEATHERMAP_API_KEY');

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/forecast?lat=$latitude&lon=$longitude&appid=$api_key&units=metric");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);

    return array_reduce($data->list, function (array $carry, $forecast) {
        $forecast->time = date('H:i:s', $forecast->dt);
        $carry[] = $forecast;
        return $carry;
    }, []);
}
