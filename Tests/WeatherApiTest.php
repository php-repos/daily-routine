<?php

namespace Tests\WeatherApiTest;

use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;
use function Tests\Helper\down;
use function Tests\Helper\get_json;
use function Tests\Helper\up;

test(
    title: 'it should return weather for the given latitude and longitude',
    case: function () {
        $latitude = 37.7749;
        $longitude = -122.4194;

        $url = "/weather?latitude=$latitude&longitude=$longitude";
        $response = get_json($url);
        assert_true(count($response) === 40);
    },
    before: function () {
        return up();
    },
    after: function ($process) {
        down($process);
    }
);
