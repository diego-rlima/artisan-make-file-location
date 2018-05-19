<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\ExceptionMakeCommand as OriginalExceptionMakeCommand;

class ExceptionMakeCommand extends OriginalExceptionMakeCommand
{
    use TraitCommand;

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        $className = $this->getDefaultNamespace($this->rootNamespace()) . "\\$rawName";

        return class_exists($rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->amflCustomNamespace($rootNamespace);
    }

    /**
     * Configure the options.
     *
     * @return void
     */
    protected function amflInit()
    {
        $this->amflCommandSetup('exception');
    }
}
