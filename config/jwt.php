<?php 

    return[
        'secret' => env('JWT_SECRET', env('APP_KEY')),

        'algorithm' => 'HS256',

        'issuer' => env('APP_URL'),

        'access_ttl' => 15,

        'refresh_ttl' => 60 * 24 * 7,
    ];

?>
