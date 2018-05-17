<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Files namespaces
    |--------------------------------------------------------------------------
    |
    | This array contains all namespaces of the files that will be generated.
    |
    */

    'namespaces' => [
        'job' => '{root}\{prefix}\Jobs\{suffix}',
        'mail' => '{root}\{prefix}\Mail\{suffix}',
        'test' => [
            'unit' => '{root}\{prefix}\Unit\{suffix}',
            'feature' => '{root}\{prefix}\Feature\{suffix}',
        ],
        'event' => '{root}\{prefix}\Events\{suffix}',
        'model' => '{root}\{prefix}\\',
        'policy' => '{root}\{prefix}\Policies\{suffix}',
        'command' => '{root}\{prefix}\Commands\{suffix}',
        'request' => '{root}\{prefix}\Requests\{suffix}',
        'listener' => '{root}\{prefix}\Listeners\{suffix}',
        'provider' => '{root}\{prefix}\Providers\{suffix}',
        'notification' => '{root}\{prefix}\Notifications\{suffix}',
        'controller' => '{root}\{prefix}\Controllers\{suffix}',
        'middleware' => '{root}\{prefix}\Middleware\{suffix}',
    ],

    /*
    |--------------------------------------------------------------------------
    | Files locations
    |--------------------------------------------------------------------------
    |
    | This array contains all locations of files that that will be generated
    | and don't have namespaces.
    |
    */

    'locations' => [
        'seeder' => '{root}/{prefix}/seeds/{name}.php',
        'migration' => '{root}/{prefix}/migrations',
    ],

];
