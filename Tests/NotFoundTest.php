<?php

namespace Tests\NotFoundTest;

use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;
use function Tests\Helper\down;
use function Tests\Helper\get;
use function Tests\Helper\up;

test(
    title: 'it should show not found page when url does not exist',
    case: function () {
        assert_true(str_contains(get('/a-not-found-url'), 'Oops! Page Not Found'));
    },
    before: function () {
        return up();
    },
    after: function ($process) {
        down($process);
    }
);
