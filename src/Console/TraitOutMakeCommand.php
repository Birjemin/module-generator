<?php
/**
 * Created by PhpStorm.
 * User: birjemin
 * Date: 13/05/2018
 * Time: 10:57 AM
 */

namespace Birjemin\ModuleGenerator\Console;


use Illuminate\Console\GeneratorCommand;

class TraitOutMakeCommand extends GeneratorCommand
{
    protected $name = 'module-generator:trait-out';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a trait out file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'trait';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/trait.out.stub';
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
        $class         = str_replace($this->getNamespace($name).'\\', '', $name);
        $moduleName    = str_replace('OutTrait', '', $class);
        $strModuleName = strtolower($moduleName);
        $stub          = str_replace('DummyModule', $moduleName, $stub);
        $stub          = str_replace('DummyStrModule', $strModuleName, $stub);
        return str_replace('DummyClass', $class, $stub);
    }
}