<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\EventMakeCommand as OriginalEventMakeCommand;

class EventMakeCommand extends OriginalEventMakeCommand
{
    use TraitCommand;

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->amflCustomNamespace($rootNamespace, 'event');
    }
}