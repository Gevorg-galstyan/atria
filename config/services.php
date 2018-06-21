<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
    | Acacha Llum services...
    |
    | See: https://github.com/acacha/llum
    |
    */
    #llum_services
    'facebook' => [
        'client_id' => '452114811824919',
        'client_secret' => '15dd925c66dbeb31e875daaca30bc4fa',
        'redirect' => 'http://atria.am/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '236450857333-9dl6lqp1cnndln7avrrt4fuije5go9tq.apps.googleusercontent.com',
        'client_secret' => '0rIJs398nqed3pqFLlQzF2ne',
        'redirect' => 'http://atria.am/login/google/callback',
    ],


];
