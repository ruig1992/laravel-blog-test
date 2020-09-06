<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ImageSearch services config file
    |--------------------------------------------------------------------------
    */

    'cache' => [
        'enabled' => true,
        'data_key' => 'image_search_results',
        'ttl' => 86400, // 1 day
    ],

    'google' => [
        // For creation Search Engine ID you have to go to https://cse.google.com/cse
        'engine_id' => env('IMAGE_SEARCH_GOOGLE_ENGINE_ID', '91d967948853bc9b8'),

        // For generation API key you have to go to https://console.developers.google.com
        // Max quota for free usage - 100 requests per 1 day
        'api_key' => env('IMAGE_SEARCH_GOOGLE_API_KEY', 'AIzaSyA6za0pH0aUBsv0iTv65_CBJVRf6STX_J0'),

        'base_url' => env('IMAGE_SEARCH_GOOGLE_BASE_URL', 'https://customsearch.googleapis.com/customsearch/v1?searchType=image'),
    ],
];
