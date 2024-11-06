<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | A great default configuration has been defined for you which uses
    | session storage and the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved from your database or other storage
    | systems used by the application.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'role' => [  // Custom guard for roles
            'driver' => 'session',
            'provider' => 'roles',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved from your database or other storage
    | systems used by the application.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent each model/table. These providers may then
    | be assigned to any extra authentication guards you define.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'roles' => [  // Custom provider for Role model
            'driver' => 'eloquent',
            'model' => App\Models\Role::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These options control the password reset behavior, including the token
    | storage table and the user provider invoked to retrieve users.
    |
    | The expiry time is the number of minutes each reset token is valid.
    | You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating additional password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the seconds before a password confirmation
    | expires and users are asked to re-enter their password.
    | By default, the timeout lasts three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
