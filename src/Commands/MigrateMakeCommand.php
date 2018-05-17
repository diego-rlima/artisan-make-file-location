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
    protected function getMigrationPath()
    {
        $basePath = $this->laravel->basePath();

        if (! is_null($targetPath = $this->input->getOption('path'))) {
            return $basePath.'/'.$targetPath;
        }

        return $this->amflCustomPath($basePath, 'migration', '');
    }

    /**
     * Get the default prefix.
     *
     * @return string
     */
    protected function amflDefaultPrefix()
    {
        return 'database';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
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
    protected function getOptions()
    {
        $options = [
            ['create', null, InputOption::VALUE_OPTIONAL, 'The table to be created.'],
            ['table', null, InputOption::VALUE_OPTIONAL, 'The table to migrate.'],
            ['path', null, InputOption::VALUE_OPTIONAL, 'The location where the migration file should be created.'],
        ];

        return array_merge(
            $options,
            $this->amflOptions()
        );
    }
}
