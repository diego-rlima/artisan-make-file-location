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

    'channel' => '{root}\{prefix}\Broadcasting\{suffix}',
    'command' => '{root}\{prefix|default:Console}\Commands\{suffix}',
    'controller' => '{root}\{prefix|default:Http}\Controllers\{suffix}',
    'event' => '{root}\{prefix}\Events\{suffix}',
    'exception' => '{root}\{prefix}\Exceptions\{suffix}',
    'job' => '{root}\{prefix}\Jobs\{suffix}',
    'listener' => '{root}\{prefix}\Listeners\{suffix}',
    'mail' => '{root}\{prefix}\Mail\{suffix}',
    'middleware' => '{root}\{prefix|default:Http}\Middleware\{suffix}',
    'model' => '{root}\{prefix}',
    'notification' => '{root}\{prefix}\Notifications\{suffix}',
    'policy' => '{root}\{prefix}\Policies\{suffix}',
    'provider' => '{root}\{prefix}\Providers\{suffix}',
    'request' => '{root}\{prefix|default:Http}\Requests\{suffix}',
    'resource' => '{root}\{prefix|default:Http}\Resources\{suffix}',
    'rule' => '{root}\{prefix}\Rules\{suffix}',
    'test' => '{root}\{prefix}\{type}\{suffix}',

    /*
    |--------------------------------------------------------------------------
    | Files locations
    |--------------------------------------------------------------------------
    |
    | This array contains all locations of files that that will be generated
    | and don't have namespaces.
    |
    */

    'factory' => '{root}/{prefix|default:database}/factories/{name}.php',
    'migration' => '{root}/{prefix|default:database}/migrations',
    'seeder' => '{root}/{prefix|default:database}/seeds/{name}.php',

];
