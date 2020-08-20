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
        $customCommands = CommandsList::getCustomCommands();
        $commandsList = array_values($commands) + array_keys($customCommands);

        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        foreach ($customCommands as $command => $callback) {
            $this->app->extend($command, $callback);
        }

        $this->commands($commandsList);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConsoleMakeCommand(): void
    {
        $this->app->extend('command.console.make', function () {
            return new Commands\ConsoleMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand(): void
    {
        $this->app->extend('command.controller.make', function () {
            return new Commands\ControllerMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventMakeCommand(): void
    {
        $this->app->extend('command.event.make', function () {
            return new Commands\EventMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerJobMakeCommand(): void
    {
        $this->app->extend('command.job.make', function () {
            return new Commands\JobMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerListenerMakeCommand(): void
    {
        $this->app->extend('command.listener.make', function () {
            return new Commands\ListenerMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMailMakeCommand(): void
    {
        $this->app->extend('command.mail.make', function () {
            return new Commands\MailMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMiddlewareMakeCommand(): void
    {
        $this->app->extend('command.middleware.make', function () {
            return new Commands\MiddlewareMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateMakeCommand(): void
    {
        $this->app->extend('command.migrate.make', function () {
            $creator = $this->app->get('migration.creator');
            $composer = $this->app->get('composer');

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
        $this->app->extend('command.model.make', function () {
            return new Commands\ModelMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerNotificationMakeCommand(): void
    {
        $this->app->extend('command.notification.make', function () {
            return new Commands\NotificationMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerProviderMakeCommand(): void
    {
        $this->app->extend('command.provider.make', function () {
            return new Commands\ProviderMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRequestMakeCommand(): void
    {
        $this->app->extend('command.request.make', function () {
            return new Commands\RequestMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSeederMakeCommand(): void
    {
        $this->app->extend('command.seeder.make', function () {
            return new Commands\SeederMakeCommand($this->app->get('files'), $this->app->get('composer'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTestMakeCommand(): void
    {
        $this->app->extend('command.test.make', function () {
            return new Commands\TestMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPolicyMakeCommand(): void
    {
        $this->app->extend('command.policy.make', function () {
            return new Commands\PolicyMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerExceptionMakeCommand(): void
    {
        $this->app->extend('command.exception.make', function () {
            return new Commands\ExceptionMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFactoryMakeCommand(): void
    {
        $this->app->extend('command.factory.make', function () {
            return new Commands\FactoryMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceMakeCommand(): void
    {
        $this->app->extend('command.resource.make', function () {
            return new Commands\ResourceMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRuleMakeCommand(): void
    {
        $this->app->extend('command.rule.make', function () {
            return new Commands\RuleMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerChannelMakeCommand(): void
    {
        $this->app->extend('command.channel.make', function () {
            return new Commands\ChannelMakeCommand($this->app->get('files'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        $commands = CommandsList::toLoad($this->app::VERSION);
        $customCommands = CommandsList::getCustomCommands();

        return array_values($commands) + array_keys($customCommands);
    }
}
