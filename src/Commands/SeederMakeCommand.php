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
    protected function getPath($name)
    {
        return $this->amflCustomPath($this->laravel->basePath(), 'seeder', $name);
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
}
