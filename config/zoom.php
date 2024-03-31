<?php

return [
    'account_id' => env('ZOOM_ACCOUNT_ID'),
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'cache_token' => env('ZOOM_CACHE_TOKEN', true),
    'base_url' => 'https://zoom.us/oauth/authorize?response_type=code&client_id=IVCM6T10R22rByCoZr62A&redirect_uri=http%3A%2F%2F127.0.0.1%3A8000%2Fen%2FOnlineClass',
    'authentication_method' => 'Oauth', // Only Oauth compatible at present
    'max_api_calls_per_request' => '5' // how many times can we hit the api to return results for an all() request
];
