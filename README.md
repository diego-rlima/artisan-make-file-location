# diego-rlima/artisan-make-file-location
Ability to change the namespace/location of the files generated by the \"artisan make\" commands.

## Requirements
This package require **Laravel 5.4**.

## Installation
```bash
$ composer require diego-rlima/artisan-make-file-location
```
And add the service provider in `config/app.php`:

```php
DRL\AMFL\ArtisanServiceProvider::class,
```

## Using
You can use all "artisan make" commands as usual. But now, you can add the options **--prefix** and **--suffix** to change the namespace of your files.

**Note:** For files that do not have namespace (like migrations), only the prefix can be used.

### Prefix
```bash
$ php artisan make:controller ProductController --prefix=Units\\Products\\Controllers
```

This will output the file with the namespace **App\Units\Products\Controllers**.

### Suffix
```bash
$ php artisan make:controller ProductController --suffix=Products
```

This will output the file with the namespace **App\Http\Controllers\Products**.

### Both Prefix and Suffix

```bash
$ php artisan make:controller ProductController --prefix=Units --suffix=Products
```
This will output the file with the namespace **App\Units\Controllers\Products**.


## Customizing
The package is configured to be compatible with the Laravel standard, but allowing you to set prefixes and suffixes. However, you can replace the Laravel pattern with your own.

Publish the config using the following command:
```bash
$ php artisan vendor:publish --provider="DRL\AMFL\ArtisanServiceProvider"
```

Now you have a [config/amfl.php](https://github.com/diego-rlima/artisan-make-file-location/blob/master/config/amfl.php) file.
The settings are divided between files that have namespaces and files that they do not have.

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Files namespaces
    |--------------------------------------------------------------------------
    */

    'namespaces' => [
        // Code omitted
        'controller' => '{root}\{prefix}\Controllers\{suffix}',
        'model' => '{root}\{prefix}\\',
        'test' => [
            'unit' => '{root}\{prefix}\Unit\{suffix}',
            'feature' => '{root}\{prefix}\Feature\{suffix}',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Files locations
    |--------------------------------------------------------------------------
    */

    'locations' => [
        'migration' => '{root}/{prefix}/migrations',
        'seeder' => '{root}/{prefix}/seeds/{name}.php',
    ],
];
```

For files with namespace, the **{root}** normally will be replaced by the "App" namespace. Of curse, **{prefix}** and **{suffix}** will be replaced by the prefix and suffix you choose.

**Note:** In the test files, **{root}** will be changed to "Tests" namespace. These files also have namespace variation for "unit" and "feature".

For files without namespace, the **{root}** will be replaced by the root directory of application. The **{prefix}** and **{name}** will be replaced by the prefix and the file name, respectively.


## List of commands supported
Command             | Supports prefix | Supports suffix
:-------------------|:----------------|:----------------
make:command        | yes             | yes
make:controller     | yes             | yes
make:event          | yes             | yes
make:job            | yes             | yes
make:listener       | yes             | yes
make:mail           | yes             | yes
make:middleware     | yes             | yes
make:model          | yes             | no
make:notification   | yes             | yes
make:policy         | yes             | yes
make:provider       | yes             | yes
make:request        | yes             | yes
make:test           | yes             | yes
make:migration      | yes             | no
make:seeder         | yes             | no