<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\ConsoleMakeCommand as OriginalConsoleMakeCommand;

class ConsoleMakeCommand extends OriginalConsoleMakeCommand
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
        return $this->amflCustomNamespace($rootNamespace, 'command');
    }

    /**
     * Get the default prefix.
     *
     * @return string
     */
    protected function amflDefaultPrefix()
    {
        return 'Console';
    }
}
