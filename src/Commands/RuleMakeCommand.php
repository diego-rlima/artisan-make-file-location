<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Foundation\Console\RuleMakeCommand as OriginalRuleMakeCommand;

class RuleMakeCommand extends OriginalRuleMakeCommand
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
        return $this->amflCustomNamespace($rootNamespace);
    }

    /**
     * Configure the options.
     *
     * @return void
     */
    protected function amflInit()
    {
        $this->amflCommandSetup('rule');
    }
}
