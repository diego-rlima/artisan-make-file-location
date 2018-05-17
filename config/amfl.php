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
        'command' => '{root}\{prefix}\Commands\{suffix}',
        'controller' => '{root}\{prefix}\Controllers\{suffix}',
        'event' => '{root}\{prefix}\Events\{suffix}',
        'exception' => '{root}\{prefix}\Exceptions\{suffix}',
        'job' => '{root}\{prefix}\Jobs\{suffix}',
        'listener' => '{root}\{prefix}\Listeners\{suffix}',
        'mail' => '{root}\{prefix}\Mail\{suffix}',
        'middleware' => '{root}\{prefix}\Middleware\{suffix}',
        'model' => '{root}\{prefix}\\',
        'notification' => '{root}\{prefix}\Notifications\{suffix}',
        'policy' => '{root}\{prefix}\Policies\{suffix}',
        'provider' => '{root}\{prefix}\Providers\{suffix}',
        'request' => '{root}\{prefix}\Requests\{suffix}',
        'resource' => '{root}\{prefix}\Resources\{suffix}',
        'rule' => '{root}\{prefix}\Rules\{suffix}',
        'test' => [
            'feature' => '{root}\{prefix}\Feature\{suffix}',
            'unit' => '{root}\{prefix}\Unit\{suffix}',
        ],
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
        'factory' => '{root}/{prefix}/factories/{name}.php',
        'migration' => '{root}/{prefix}/migrations',
        'seeder' => '{root}/{prefix}/seeds/{name}.php',
    ],

];
