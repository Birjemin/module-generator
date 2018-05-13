<?php

/**
 * Created by PhpStorm.
 * User: birjemin
 * Date: 09/05/2018
 * Time: 12:35 AM
 */
namespace Birjemin\ModuleGenerator\Console;


use Illuminate\Console\GeneratorCommand;

/**
 * Class ProviderMakeCommand
 * @package Birjemin\ModuleGenerator\Console
 */
class ProviderMakeCommand  extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module-generator:provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a provider file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'module';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/provider.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    protected function replaceClass($stub, $name)
    {
        $class           = str_replace($this->getNamespace($name) . '\\', '', $name);
        $moduleNameSpace = str_replace('Provider', '', $this->getNamespace($name));
        $moduleName      = str_replace('Provider', '', $class);
        $lowerModuleName = strtolower($moduleName);
        $stub            = str_replace('DummyModuleNameSpace', $moduleNameSpace, $stub);
        $stub            = str_replace('DummyLowerModuleName', $lowerModuleName, $stub);
        $stub            = str_replace('DummyModuleName', $moduleName, $stub);

        return str_replace('DummyClass', $class, $stub);
    }
}