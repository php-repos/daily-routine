<?php

namespace PhpRepos\DailyRoutines\Kernel\UI\Html;

use function PhpRepos\FileManager\Resolver\root;

function view(string $filename, ?array $variables = []): string
{
    extract($variables);
    ob_start();
    require_once(root() . '../Resources/Html/' . $filename . '.view.php');

    return ob_get_clean();
}
