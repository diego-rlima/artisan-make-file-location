<?php

namespace DRL\AMFL\Commands;

use DRL\AMFL\TraitCommand;
use Illuminate\Database\Console\Factories\FactoryMakeCommand as OriginalFactoryMakeCommand;

class FactoryMakeCommand extends OriginalFactoryMakeCommand
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
        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        );

        return $this->amflCustomPath($this->laravel->basePath(), 'factory', $name);
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
