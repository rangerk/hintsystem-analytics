<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '730335733800375',
        'client_secret' => '7caaae329f6a41f9ffe7405ba3d6c322',
        'redirect' => 'http://dev.hintsystem.com/welcome'
    ],
    'twitter' => [
        'client_id' => 'app-id',
        'client_secret' => 'app-secret',
        'redirect' => 'http://dev.hintsystem.com/welcome'
    ],
    'linkedin' => [
        'client_id' => 'app-id',
        'client_secret' => 'app-secret',
        'redirect' => 'http://dev.hintsystem.com/welcome'
    ],
    'google' => [
        'client_id' => '354909890026-4vf7hla951ttnnmi7ish3e3mdc0j5ehp.apps.googleusercontent.com',
        'client_secret' => 'rVwOoLXJMSONscg5G45LyDr1',
        'redirect' => 'http://dev.hintsystem.com/welcome'
    ],
];
