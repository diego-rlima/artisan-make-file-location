<?php

namespace DRL\AMFL;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Path to configuration file.
     *
     * @return string
     */
    public function configPath(): string
    {
        return realpath(__DIR__ . '/../config/amfl.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([$this->configPath() => config_path('amfl.php')], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath(), 'amfl');
        $this->registerCommands();
    }

    /**
     * Register the given commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        $commands = CommandsList::toLoad($this->app::VERSION);

        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConsoleMakeCommand(): void
    {
        $this->app->singleton('command.console.make', function ($app) {
            return new Commands\ConsoleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand(): void
    {
        $this->app->singleton('command.controller.make', function ($app) {
            return new Commands\ControllerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventMakeCommand(): void
    {
        $this->app->singleton('command.event.make', function ($app) {
            return new Commands\EventMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerJobMakeCommand(): void
    {
        $this->app->singleton('command.job.make', function ($app) {
            return new Commands\JobMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerListenerMakeCommand(): void
    {
        $this->app->singleton('command.listener.make', function ($app) {
            return new Commands\ListenerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMailMakeCommand(): void
    {
        $this->app->singleton('command.mail.make', function ($app) {
            return new Commands\MailMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMiddlewareMakeCommand(): void
    {
        $this->app->singleton('command.middleware.make', function ($app) {
            return new Commands\MiddlewareMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateMakeCommand(): void
    {
        $this->app->singleton('command.migrate.make', function ($app) {
            $creator = $app['migration.creator'];
            $composer = $app['composer'];

            return new Commands\MigrateMakeCommand($creator, $composer);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand(): void
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new Commands\ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerNotificationMakeCommand(): void
    {
        $this->app->singleton('command.notification.make', function ($app) {
            return new Commands\NotificationMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerProviderMakeCommand(): void
    {
        $this->app->singleton('command.provider.make', function ($app) {
            return new Commands\ProviderMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRequestMakeCommand(): void
    {
        $this->app->singleton('command.request.make', function ($app) {
            return new Commands\RequestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSeederMakeCommand(): void
    {
        $this->app->singleton('command.seeder.make', function ($app) {
            return new Commands\SeederMakeCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTestMakeCommand(): void
    {
        $this->app->singleton('command.test.make', function ($app) {
            return new Commands\TestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPolicyMakeCommand(): void
    {
        $this->app->singleton('command.policy.make', function ($app) {
            return new Commands\PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerExceptionMakeCommand(): void
    {
        $this->app->singleton('command.exception.make', function ($app) {
            return new Commands\ExceptionMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFactoryMakeCommand(): void
    {
        $this->app->singleton('command.factory.make', function ($app) {
            return new Commands\FactoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceMakeCommand(): void
    {
        $this->app->singleton('command.resource.make', function ($app) {
            return new Commands\ResourceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRuleMakeCommand(): void
    {
        $this->app->singleton('command.rule.make', function ($app) {
            return new Commands\RuleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerChannelMakeCommand(): void
    {
        $this->app->singleton('command.channel.make', function ($app) {
            return new Commands\ChannelMakeCommand($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return array_values(CommandsList::toLoad($this->app::VERSION));
    }
}
