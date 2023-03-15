<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\NewsApi\Headlines;

use DateTime;

function get(): array
{
    $api_key = getenv("NEWSAPI_API_KEY");

    // URL for the top headlines API endpoint
    $url = "https://newsapi.org/v2/top-headlines?country=us&category=technology&apiKey=$api_key";

    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'phpkg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Send the HTTP request and get the response
    $response = curl_exec($ch);

    // Check for errors in the request
    if(curl_errno($ch)){
        echo 'Error: ' . curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    $articles = $data['articles'];

    foreach ($articles as $key => $article) {
        $articles[$key]['publishedAt'] = new DateTime($article['publishedAt']);
    }

    return $articles;
}
