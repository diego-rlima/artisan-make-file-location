<?php

namespace DRL\AMFL;

class CommandsList
{
    protected static $customCommands = [];

    /**
     * Returns all commands that must be loaded, based on the Laravel version.
     *
     * @param  string  $laravelVersion
     * @return array
     */
    public static function toLoad(string $laravelVersion): array
    {
        $load = [];

        foreach(self::list() as $version => $commands) {
            if (version_compare($laravelVersion, $version, '>=')) {
                $load += $commands;
            }
        }

        return $load;
    }

    /**
     * Returns all custom commands that must be loaded.
     *
     * @return array
     */
    public static function getCustomCommands(): array
    {
        return self::$customCommands;
    }

    /**
     * The commands to be registered, separating them by the Laravel version.
     *
     * @return array
     */
    protected static function list(): array
    {
        return [
            '5.4.0' => [
                'ConsoleMake' => 'command.console.make',
                'ControllerMake' => 'command.controller.make',
                'EventMake' => 'command.event.make',
                'JobMake' => 'command.job.make',
                'ListenerMake' => 'command.listener.make',
                'MailMake' => 'command.mail.make',
                'MiddlewareMake' => 'command.middleware.make',
                'MigrateMake' => 'command.migrate.make',
                'ModelMake' => 'command.model.make',
                'NotificationMake' => 'command.notification.make',
                'PolicyMake' => 'command.policy.make',
                'ProviderMake' => 'command.provider.make',
                'RequestMake' => 'command.request.make',
                'SeederMake' => 'command.seeder.make',
                'TestMake' => 'command.test.make',
            ],
            '5.5.0' => [
                'ExceptionMake' => 'command.exception.make',
                'FactoryMake' => 'command.factory.make',
                'ResourceMake' => 'command.resource.make',
                'RuleMake' => 'command.rule.make',
            ],
            '5.6.0' => [
                'ChannelMake' => 'command.channel.make',
            ],
        ];
    }

    public static function extend(string $command, callable $callback): void
    {
        self::$customCommands[$command] = $callback;
    }
}
