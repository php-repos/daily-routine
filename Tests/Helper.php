<?php

namespace Tests\Helper;

use function PhpRepos\FileManager\Resolver\root;

function up(): int
{
    $directory = root() . 'Public/';
    $port = 8000;

    $command = "php -S localhost:$port -t $directory";

    exec("$command > /dev/null 2>&1 & echo $!", $output);

    $pid = $output[0];

    // Wait for the server to start up
    sleep(1);

    // Check if the server is running
    exec("ps $pid", $is_running);

    if (!count($is_running) >= 2) {
        echo "Failed to start server." . PHP_EOL;
        posix_kill($pid, SIGKILL);
        exit(1);
    }

    return $pid;
}

function down(int $pid)
{
    posix_kill($pid, SIGKILL);
}

function get(string $url): string
{
    $url = "http://localhost:8000$url";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: text/html"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
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
