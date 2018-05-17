<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Routing\Console\ControllerMakeCommand as OriginalControllerMakeCommand;

class ControllerMakeCommand extends OriginalControllerMakeCommand
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
        return $this->amflCustomNamespace($rootNamespace, 'controller');
    }

    /**
     * Get the default prefix.
     *
     * @return string
     */
    protected function amflDefaultPrefix()
    {
        return 'Http';
    }
}
