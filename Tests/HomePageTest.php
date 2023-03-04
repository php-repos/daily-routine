<?php

namespace Tests\HomePageTest;

use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;
use function Tests\Helper\down;
use function Tests\Helper\get;
use function Tests\Helper\up;

test(
    title: 'it should show the home page',
    case: function ($pid) {
        $response = get('/');

        assert_has_greeting($response);
        assert_has_ram_status($response);
        assert_has_hard_status($response);
        assert_has_crypto_price_list($response);
        assert_has_weather_forecast($response);
        assert_has_news_artciles($response);

        return $pid;
    },
    before: function () {
        return up();
    },
    after: function ($pid) {
        down($pid);
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
    assert_true(str_contains($response, "Crypto"), 'Crypto price list is not on the output.');
}

function assert_has_weather_forecast(string $response)
{
    assert_true(str_contains($response, "Weather Forecast"), 'Weather forecast is not on the output.');
}

function assert_has_news_artciles(string $response)
{
    assert_true(str_contains($response, "News"), 'News section is not on the output.');
}
