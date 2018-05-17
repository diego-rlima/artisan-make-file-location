<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\ChannelMakeCommand as OriginalChannelMakeCommand;

class ChannelMakeCommand extends OriginalChannelMakeCommand
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
        return $this->amflCustomNamespace($rootNamespace, 'channel');
    }
}
