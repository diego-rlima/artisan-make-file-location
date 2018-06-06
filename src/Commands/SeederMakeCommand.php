<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Database\Console\Seeds\SeederMakeCommand as OriginalSeederMakeCommand;

class SeederMakeCommand extends OriginalSeederMakeCommand
{
    use TraitCommand;

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name): string
    {
        return $this->amflCustomPath($this->laravel->basePath(), $name);
    }

    /**
     * Configure the options.
     *
     * @return void
     */
    protected function amflInit(): void
    {
        $this->amflCommandSetup('seeder');
    }
}
