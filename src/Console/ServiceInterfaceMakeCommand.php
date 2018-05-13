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
 * Class ServiceInterfaceMakeCommand
 * @package Birjemin\ModuleGenerator\Console
 */
class ServiceInterfaceMakeCommand  extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module-generator:serviceInterface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/service.interface.stub';
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
}