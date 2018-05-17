<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\Console\TestMakeCommand as OriginalTestMakeCommand;

class TestMakeCommand extends OriginalTestMakeCommand
{
    use TraitCommand;

    protected $signature = null;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:test';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $type = $this->option('unit') ? 'unit' : 'feature';

        return $this->amflCustomNamespace($rootNamespace, 'test.' . $type);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class.']
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
            ['unit', null, InputOption::VALUE_NONE, 'Create a unit test.'],
        ];

        return array_merge(
            $options,
            $this->amflOptions()
        );
    }
}
