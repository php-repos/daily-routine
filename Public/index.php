<?php

use PhpRepos\DailyRoutines\Kernel\Bootstrap;
use PhpRepos\DailyRoutines\Kernel\IO\Request\Utils;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Response;
use PhpRepos\DailyRoutines\Kernel\IO\Response\Status;
use PhpRepos\DailyRoutines\Kernel\Router;
use PhpRepos\DailyRoutines\Kernel\UI\Html;

$application = Bootstrap\boot();
$request = Utils\parse_http();

$endpoint = Router\http($request, $application->routes);
$response = is_callable($endpoint)
    ? call_user_func($endpoint, $request)
    : Response::html(Html\view('404'), status: Status::NOT_FOUND);

http_response_code($response->header->status->value);
header('Content-Type: ' . $response->header->content_type);
echo $response->body->content;
