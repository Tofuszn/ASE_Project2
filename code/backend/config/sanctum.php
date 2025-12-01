<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically these should include your local
    | and production domains where your frontend is running.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost,127.0.0.1')),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | This value instructs Sanctum to authenticate requests using the
    | following guards. If none of these guards are able to
    | authenticate the request, Sanctum will use the bearer
    | token that's provided in the request for auth.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will
    | be considered expired. This will override any values set on the
    | token instance itself. Null means the token does not expire.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Sanctum can prefix new tokens with a string so you know who issued
    | the token. This is primarily useful if you have multiple apps
    | sharing the same database or codebase and need to know how
    | the tokens were issued. Defaults to no prefix.
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

];
