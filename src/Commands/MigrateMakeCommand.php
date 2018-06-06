<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand as OriginalMigrateMakeCommand;

class MigrateMakeCommand extends OriginalMigrateMakeCommand
{
    use TraitCommand;

    protected $signature = null;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:migration';

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath(): string
    {
        $basePath = $this->laravel->basePath();

        if (! is_null($targetPath = $this->input->getOption('path'))) {
            return $basePath.'/'.$targetPath;
        }

        return $this->amflCustomPath($basePath, '');
    }

    /**
     * Configure the options.
     *
     * @return void
     */
    protected function amflInit(): void
    {
        $this->amflCommandSetup('migration');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration.']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $this->amflInit();
        $this->amflOptions();

        return [
            ['create', null, InputOption::VALUE_OPTIONAL, 'The table to be created.'],
            ['table', null, InputOption::VALUE_OPTIONAL, 'The table to migrate.'],
            ['path', null, InputOption::VALUE_OPTIONAL, 'The location where the migration file should be created.'],
        ];
    }
}
