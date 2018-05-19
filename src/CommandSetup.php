<?php

namespace DRL\AMFL;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class CommandSetup
{
    /**
     * Configuration of the file to be generated.
     *
     * @var string
     */
    protected $config;

    /**
     * The Command instance.
     *
     * @var \Symfony\Component\Console\Command\Command
     */
    protected $makeCommand;

    /**
     * Name of the command.
     *
     * @var string
     */
    protected $command;

    /**
     * The available options.
     *
     * @var array
     */
    protected $options = [
        'prefix' => 'Set the custom namespace/path prefix.',
        'suffix' => 'Set the custom namespace suffix.'
    ];

    /**
     * The options data.
     *
     * @var array
     */
    protected $optionsData = [];

    /**
     * Create a new CommandSetup instance.
     *
     * @param  \Symfony\Component\Console\Command\Command  $command
     * @param  string  $command
     * @return void
     */
    public function __construct(Command $makeCommand, string $command)
    {
        $this->makeCommand = $makeCommand;
        $this->command = $command;
        $this->config = config('amfl.' . $command);
    }

    /**
     * Disables an option.
     *
     * @param  string  $option
     * @return self
     */
    public function disableOption(string $option)
    {
        unset($this->options[$option]);

        return $this;
    }

    /**
     * Load the available options .
     *
     * @return self
     */
    public function loadOptions()
    {
        foreach (array_keys($this->options) as $option) {
            $this->parse($option);
        }

        return $this;
    }

    /**
     * Explode the option attributes into an array.
     *
     * @param  string  $attributes
     * @return array
     */
    protected function explodeAttributes(string $attributes): array
    {
        $attributes = explode('|', $attributes);
        unset($attributes[0]);

        return $attributes;
    }

    /**
     * Saves the option data.
     *
     * @param  string  $option
     * @param  array  $attributes
     * @return void
     */
    protected function saveOptionData(string $option, array $attributes)
    {
        $data = [
            'required' => $this->isRequired($attributes),
            'default' => $this->defaultValue($attributes) ?: null,
        ];

        $this->optionsData[$option] = $data;
    }

    /**
     * Check if the option is required.
     *
     * @param  array  $attributes
     * @return bool
     */
    protected function isRequired(array $attributes): bool
    {
        return in_array('required', $attributes);
    }

    /**
     * Gets the default value of the option.
     *
     * @param  array  $attributes
     * @return string|null
     */
    protected function defaultValue(array $attributes)
    {
        $value = array_first($attributes, function($attribute) {
            return starts_with($attribute, 'default:');
        }, '');

        return str_replace('default:', '', $value);
    }

    /**
     * Checks if the option exists in the configuration. If not, disables
     * the option.
     *
     * @param  string  $option
     * @return string|false
     */
    public function match(string $option)
    {
        $pattern = '/.*\{' . $option . '([^\}]*).*$/';

        if (preg_match($pattern, $this->config, $match) == 1) {
            return $match[1];
        }

        $this->disableOption($option);

        return false;
    }

    /**
     * Replaces a pattern with the given value.
     *
     * @param  string  $needle
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    public function replace(string $needle, string $replace, string $subject): string
    {
        $pattern = '/\{' . $needle . '([^\}]*)./';

        return preg_replace($pattern, $replace, $subject);
    }

    /**
     * Checks if the option exists, gets the attributes and saves the data.
     *
     * @param  string  $option
     * @return void
     */
    protected function parse(string $option)
    {
        $match = $this->match($option);

        if ($match !== false) {
            $attributes = $this->explodeAttributes($match);

            $this->saveOptionData($option, $attributes);
        }
    }

    /**
     * Gets the options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Gets the option data.
     *
     * @param  string  $option
     * @return string|false
     */
    public function getOptionData(string $option)
    {
        if (isset($this->optionsData[$option])) {
            return $this->optionsData[$option];
        }

        return false;
    }

    /**
     * Validates the required options.
     *
     * @param  mixed   $value
     * @param  string  $option
     * @return void
     */
    protected function validateOption($value, string $option)
    {
        $data = $this->getOptionData($option);

        if (empty($value) && $data['required']) {
            throw new InvalidArgumentException(sprintf('The "--%s" option requires a value.', $option));
        }
    }

    /**
     * Gets the configuration formatted with the values of the options.
     *
     * @return string
     */
    public function getFormattedConfig()
    {
        $formatted = $this->config;

        foreach (array_keys($this->getOptions()) as $option) {
            $value = $this->makeCommand->option($option);

            $this->validateOption($value, $option);

            $formatted = $this->replace(
                $option,
                $this->makeCommand->option($option) ?: '',
                $formatted
            );
        }

        return $this->sanitizes($formatted);
    }

    /**
     * Sanitizes the namespaces/locations.
     *
     * @return string
     */
    protected function sanitizes($config)
    {
        $patterns = ['/\\\+/', '/\/+/'];
        $replacements = ['\\', '/'];

        $sanitizes = preg_replace($patterns, $replacements, $config);
        $sanitizes = trim($sanitizes, '\\/');

        return $sanitizes;
    }
}
