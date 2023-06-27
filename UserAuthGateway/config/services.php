<?php

return [
    'balance' => [
        'base_uri' => env('BALANCE_SERVICE_BASE_URL'),
        'secret' => env('BALANCE_SERVICE_SECRET')
    ],
    'deposit' => [
        'base_uri' => env('DEPOSIT_SERVICE_BASE_URL'),
        'secret' => env('DEPOSIT_SERVICE_SECRET')
    ],
    'withdraw' => [
        'base_uri' => env('WITHDRAW_SERVICE_BASE_URL'),
        'secret' => env('WITHDRAW_SERVICE_SECRET')
    ],
];