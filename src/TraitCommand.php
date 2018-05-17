<?php

namespace DRL\AMFL;

use Symfony\Component\Console\Input\InputOption;

trait TraitCommand
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @param  string  $config
     * @return string
     */
    protected function amflCustomNamespace($rootNamespace, $config)
    {
        $namespace = config('amfl.namespaces.' . $config);
        $configMatch = ['{root}', '{prefix}\\', '\\{suffix}'];
        $configReplace = [$rootNamespace, '', ''];

        $prefix = $this->option('prefix') ?: $this->amflDefaultPrefix();
        $suffix = $this->option('suffix') ?: $this->amflDefaultSuffix();

        if ($prefix) {
            $configReplace[1] = $prefix . '\\';
        }

        if ($suffix) {
            $configReplace[2] = '\\' . $suffix;
        }

        return rtrim(
            str_replace($configMatch, $configReplace, $namespace),
            '\\'
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootPath
     * @param  string  $config
     * @param  string  $name
     * @return string
     */
    protected function amflCustomPath($rootPath, $config, $name = '')
    {
        $path = config('amfl.locations.' . $config);
        $configMatch = ['{root}', '{name}', '{prefix}/'];
        $configReplace = [$rootPath, $name, ''];

        $prefix = $this->option('prefix') ?: $this->amflDefaultPrefix();

        if ($prefix) {
            $configReplace[2] = $prefix . '/';
        }

        return str_replace($configMatch, $configReplace, $path);
    }

    /**
     * Get the console command custom options.
     *
     * @return array
     */
    protected function amflOptions()
    {
        return [
            ['prefix', null, InputOption::VALUE_OPTIONAL, 'Set the custom namespace/path prefix.'],
            ['suffix', null, InputOption::VALUE_OPTIONAL, 'Set the custom namespace suffix.'],
        ];
    }

    /**
     * Get the default prefix.
     *
     * @return false|string
     */
    protected function amflDefaultPrefix()
    {
        return false;
    }

    /**
     * Get the default suffix.
     *
     * @return false|string
     */
    protected function amflDefaultSuffix()
    {
        return false;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(),
            $this->amflOptions()
        );
    }
}
