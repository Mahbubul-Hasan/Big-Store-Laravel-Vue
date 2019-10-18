<?php

use App\Models\User;


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
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

// Socialite--------------------------------------------------

    'facebook' => [
        'client_id' => '991095381221380',
        'client_secret' => '106da4cbfe622b5de389413ea936639c',
        'redirect' => 'https://localhost:8000/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '674596977131-ch1c4i0dfpj4tq4607qd3lm1dqasj0cg.apps.googleusercontent.com',
        'client_secret' => 'QQ3kyULdm4ECRAUs6NuCNqMp',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

];
