<?php

namespace Tests\NotFoundTest;

use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;
use function Tests\Helper\down;
use function Tests\Helper\get;
use function Tests\Helper\up;

test(
    title: 'it should show not found page when url does not exist',
    case: function (int $pid) {
        assert_true(str_contains(get('/a-not-found-url'), 'Oops! Page Not Found'));
        return $pid;
    },
    before: function () {
        return up();
    },
    after: function (int $pid) {
        down($pid);
    }
);
