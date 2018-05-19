<?php

namespace DRL\AMFL;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Exception\InvalidArgumentException;

trait TraitCommand
{
    /**
     * The CommandSetup instance.
     *
     * @return CommandSetup
     */
    protected $amflSetup;

    /**
     * Configure the options.
     *
     * @return void
     */
    abstract protected function amflInit();

    /**
     * Initializes the settings.
     *
     * @param  string  $command
     * @return CommandSetup
     */
    public function amflCommandSetup(string $command)
    {
        $this->amflSetup = new CommandSetup($this, $command);

        return $this->amflSetup;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function amflCustomNamespace($rootNamespace): string
    {
        return $this->amflSetup->replace(
            'root',
            $rootNamespace,
            $this->amflSetup->getFormattedConfig()
        );
    }

    /**
     * Get the default path for the file.
     *
     * @param  string  $rootPath
     * @param  string  $name
     * @return string
     */
    protected function amflCustomPath($rootPath, $name = ''): string
    {
        $path = $this->amflSetup->replace(
            'root',
            $rootPath,
            $this->amflSetup->getFormattedConfig()
        );

        $path = $this->amflSetup->replace(
            'name',
            $name,
            $path
        );

        return $path;
    }

    /**
     * Adds the options.
     *
     * @return void
     */
    protected function amflOptions()
    {
        $this->amflSetup->loadOptions();

        foreach ($this->amflSetup->getOptions() as $option => $description) {
            $data = $this->amflSetup->getOptionData($option);
            $default = !$data['required'] ? $data['default'] : null;

            $this->addOption($option, null, InputOption::VALUE_REQUIRED, $description, $default);
        }
    }

    /**
     * Get the CommandSetup instance.
     *
     * @return CommandSetup
     */
    protected function getCommandSetup()
    {
        return $this->amflSetup;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $this->amflInit();
        $this->amflOptions();

        return parent::getOptions();
    }
}
