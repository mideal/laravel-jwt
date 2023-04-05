<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically, these should include your local
    | and production domains which access your API via a frontend SPA.
    |
    */

    'password' => env('JWT_PASSWORD', 'password'),

    /*
    |--------------------------------------------------------------------------
    | Algoritm
    |--------------------------------------------------------------------------
    |
    | You must specify supported algorithms for your application. See
    | https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
    | for a list of spec-compliant algorithms.
    |
    */

    'alg' => 'HS256',

    /*
    |--------------------------------------------------------------------------
    | Auth provider
    |--------------------------------------------------------------------------
    |
    | Table where will try to finde user
    |
    */

    'provider' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Jwt input storage
    |--------------------------------------------------------------------------
    |
    | Place where containing jwt token.
    | Supported: "cookie", "bearer_token"
    */

    'cookie' => 'cookie',

    /*
    |--------------------------------------------------------------------------
    | Jwt input key
    |--------------------------------------------------------------------------
    |
    | The key of jwt token. Only for cookie cookie
    |
    */

    'input_key' => 'ACCESS_TOKEN',

    /*
    |--------------------------------------------------------------------------
    | Storage key
    |--------------------------------------------------------------------------
    |
    | Name of storage key in jwt token
    |
    */

    'storage_key_jwt' => 'user_phone',

    /*
    |--------------------------------------------------------------------------
    | Storage key
    |--------------------------------------------------------------------------
    |
    | Name of storage key in database token
    |
    */
    'storage_key_database' => 'user_phone',

];
