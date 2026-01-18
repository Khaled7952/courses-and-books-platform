<?php

return [
    'mode' => env('PAYMOB_MODE', 'test'),
    'base_url' => env('PAYMOB_BASE_URL', 'https://ksa.paymob.com'),

    'hmac' => env('PAYMOB_HMAC'),
    'api_key' => env('PAYMOB_API_KEY'),

    'secret_key' => env('PAYMOB_SECRET_KEY'),
    'public_key' => env('PAYMOB_PUBLIC_KEY'),

    'integration_id' => env('PAYMOB_INTEGRATION_ID'),
    'iframe_id' => env('PAYMOB_IFRAME_ID'),
];
