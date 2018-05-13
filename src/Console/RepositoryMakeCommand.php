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
 * Class RepositoryMakeCommand
 * @package Birjemin\ModuleGenerator\Console\Command
 */
class RepositoryMakeCommand  extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module-generator:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository dir';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
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

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class      = str_replace($this->getNamespace($name) . '\\', '', $name);
        $interface  = rtrim($this->getNamespace($name), '\Impl');
        $moduleName = str_replace('Repository', '', $class);
        $stub       = str_replace('DummyInterface', $interface . '\\' . $class . 'Interface', $stub);
        $stub       = str_replace('DummyModelNameSpace', rtrim($interface, 'Repository') . 'Model\\' . $moduleName, $stub);
        $stub       = str_replace('DummyModel', $moduleName, $stub);
        return str_replace('DummyClass', $class, $stub);
    }
}