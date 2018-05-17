<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\RequestMakeCommand as OriginalRequestMakeCommand;

class RequestMakeCommand extends OriginalRequestMakeCommand
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
        return $this->amflCustomNamespace($rootNamespace, 'request');
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
