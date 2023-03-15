<?php

namespace Tests\HomePageTest;

use function PhpRepos\TestRunner\Assertions\Boolean\assert_false;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;
use function Tests\Helper\down;
use function Tests\Helper\get;
use function Tests\Helper\up;

test(
    title: 'it should show the home page',
    case: function () {
        $response = get('/');

        assert_has_greeting($response);
        assert_has_ram_status($response);
        assert_has_hard_status($response);
        assert_has_crypto_price_list($response);
        assert_has_weather_forecast($response);
        assert_has_news_artciles($response);
    },
    before: function () {
        return up();
    },
    after: function ($process) {
        down($process);
    }
);

test(
    title: 'it should not show the crypto price list when the key is not defined',
    case: function () {
        $response = get('/');

        assert_has_greeting($response);
        assert_has_ram_status($response);
        assert_has_hard_status($response);
        assert_does_not_have_crypto_list($response);
        assert_has_weather_forecast($response);
        assert_has_news_artciles($response);
    },
    before: function () {
        $api_key = getenv('COINMARKETCAP_API_KEY');
        putenv('COINMARKETCAP_API_KEY');
        $process = up();

        return [$process, $api_key];
    },
    after: function ($process, $api_key) {
        down($process);
        putenv('COINMARKETCAP_API_KEY=' . $api_key);
    }
);

test(
    title: 'it should not show the news articles when the key is not defined',
    case: function () {
        $response = get('/');

        assert_has_greeting($response);
        assert_has_ram_status($response);
        assert_has_hard_status($response);
        assert_has_crypto_price_list($response);
        assert_has_weather_forecast($response);
        assert_does_not_have_news_artciles($response);
    },
    before: function () {
        $api_key = getenv('NEWSAPI_API_KEY');
        putenv('NEWSAPI_API_KEY');
        $process = up();

        return [$process, $api_key];
    },
    after: function ($process, $api_key) {
        down($process);
        putenv('NEWSAPI_API_KEY=' . $api_key);
    }
);

test(
    title: 'it should not show the weather forecast when the key is not defined',
    case: function () {
        $response = get('/');

        assert_has_greeting($response);
        assert_has_ram_status($response);
        assert_has_hard_status($response);
        assert_has_crypto_price_list($response);
        assert_does_not_have_weather_forecast($response);
        assert_has_news_artciles($response);
    },
    before: function () {
        $api_key = getenv('OPENWEATHERMAP_API_KEY');
        putenv('OPENWEATHERMAP_API_KEY');
        $process = up();

        return [$process, $api_key];
    },
    after: function ($process, $api_key) {
        down($process);
        putenv('OPENWEATHERMAP_API_KEY=' . $api_key);
    }
);

function assert_has_greeting(string $response)
{
    $user = trim(shell_exec('whoami'));
    assert_true(str_contains($response, "Hello, $user!"), 'Username does not appear on the output.');

    $date = date('l, F j, Y');
    assert_true(str_contains($response, $date), 'Date does not appear on the output.');
}

function assert_has_ram_status(string $response)
{
    assert_true(str_contains($response, "Amount of RAM used"), 'Ram status is not on the output.');
}

function assert_has_hard_status(string $response)
{
    assert_true(str_contains($response, "Amount of space used"), 'Hard status is not on the output.');
}

function assert_has_crypto_price_list(string $response)
{
    assert_true(str_contains($response, "Crypto Price List"), 'Crypto price list is not on the output.');
}

function assert_does_not_have_crypto_list(string $response)
{
    assert_false(str_contains($response, "Crypto Price List"), 'Crypto price list is on the output.');
}

function assert_has_weather_forecast(string $response)
{
    assert_true(str_contains($response, "Weather Forecast"), 'Weather forecast is not on the output.');
}

function assert_does_not_have_weather_forecast(string $response)
{
    assert_false(str_contains($response, "Weather Forecast"), 'Weather forecast is on the output.');
}

function assert_has_news_artciles(string $response)
{
    assert_true(str_contains($response, "News Headlines"), 'News section is not on the output.');
}

function assert_does_not_have_news_artciles(string $response)
{
    assert_false(str_contains($response, "News Headlines"), 'News section is on the output.');
}
