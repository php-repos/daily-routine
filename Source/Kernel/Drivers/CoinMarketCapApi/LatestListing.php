<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\CoinMarketCapApi\LatestListing;

function get()
{
    $api_key = getenv('COINMARKETCAP_API_KEY');

    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

    $parameters = [
        'start' => '1',
        'limit' => '10', // Get the top 10 listings
        'convert' => 'USD', // Convert prices to USD
    ];

    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . $api_key,
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($parameters));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($response, true);

    return $result['data'];
}
