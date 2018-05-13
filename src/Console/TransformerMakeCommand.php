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
 * Class TransformerMakeCommand
 * @package Birjemin\ModuleGenerator\Console
 */
class TransformerMakeCommand  extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module-generator:transformer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a transformer file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'transformer';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/transformer.stub';
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
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        return str_replace('DummyClass', $class, $stub);
    }
}