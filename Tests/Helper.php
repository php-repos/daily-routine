<?php

namespace Tests\Helper;

use Exception;
use function PhpRepos\FileManager\Resolver\root;

function up()
{
    $directory = root() . 'Public/';
    $port = 8000;

    $command = "php -S localhost:$port -t $directory";

    $descriptors = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open($command, $descriptors, $pipes);
    stream_set_blocking($pipes[1], 0);
    stream_set_blocking($pipes[2], 0);

    $output = '';
    $error = '';

    $timeout = 2000000;
    $interval = 2000;

    $port_is_open = function () {
        $socket = @fsockopen('localhost', 8000, $error_code, $error_message, 0.2);

        if ($socket === false) {
            return false;
        }

        return fclose($socket);
    };

    while ($timeout > $interval) {
        usleep($interval);

        if ($port_is_open()) {
            return $process;
        }

        $status = proc_get_status($process);
        $output .= stream_get_contents($pipes[1]);
        $error .= stream_get_contents($pipes[2]);

        if ($status['running'] !== true) {
            $exception_msg = 'Error in serving the server. Exit code: ' . $status['exitcode'] . PHP_EOL;
            $exception_msg .= 'Output: ' . $output . PHP_EOL;
            $exception_msg .= 'Error: ' . $error . PHP_EOL;
            throw new Exception($exception_msg);
        }

        $timeout -= $interval;
    }

    $output .= stream_get_contents($pipes[1]);
    $error .= stream_get_contents($pipes[2]);
    $exception_msg = 'Timeout reached to open the server.' . PHP_EOL;
    $exception_msg .= 'Output: ' . $output . PHP_EOL;
    $exception_msg .= 'Error: ' . $error . PHP_EOL;

    posix_kill(proc_get_status($process)['pid'], SIGINT);

    throw new Exception($exception_msg);
}

function down($process)
{
    posix_kill(proc_get_status($process)['pid'], SIGINT);
    posix_kill(proc_get_status($process)['pid'], SIGTERM);
    $timeout = 2000000;
    $interval = 2000;

    while ($timeout > $interval) {
        usleep($interval);

        $status = proc_get_status($process);

        if (!$status['running']) {
            return;
        }

        posix_kill(proc_get_status($process)['pid'], SIGINT);
        posix_kill(proc_get_status($process)['pid'], SIGTERM);

        $timeout -= $interval;
    }

    throw new Exception('Timeout reached to kill the process.');
}

function get(string $url): string
{
    $url = "http://localhost:8000$url";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: text/html"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}

function get_json(string $url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost:8000$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 3,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "Error: " . curl_error($curl);
        $json_response = [];
    } else {
        $json_response = json_decode($response, true);
    }

    curl_close($curl);

    return $json_response;
}
