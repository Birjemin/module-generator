<?php
/**
 * Created by PhpStorm.
 * User: birjemin
 * Date: 09/05/2018
 * Time: 3:36 PM
 */

namespace Birjemin\ModuleGenerator\Console;


use Birjemin\ModuleGenerator\Config\Config;
use Illuminate\Console\GeneratorCommand;

class ModuleGeneratorCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'birjemin:module-generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the module';

    public function fire()
    {
        $moduleName = $this->argument('name');

        // make module base dir and resource
        $this->makeBaseModule();
        // make module root dir
        $this->makeDirPath($this->getBlockPath(Config::MODULE_DIR));
        // make module resource
        $this->makeDefineModule($moduleName);

        $this->info($moduleName . ' generated successfully!');
    }

    protected function makeBaseModule()
    {
        $this->callSilent('module-generator:base');
    }

    protected function makeDefineModule($moduleName)
    {
        // make block dir
        $this->makeModuleDirPath($moduleName);

        // create dir or check the dir
        $this->callSilent('module-generator:repositoryInterface', [
            'name' => $this->getModulePath($moduleName) . '\\' . Config::REPOSITORY_DIR . '\\' . $moduleName .'RepositoryInterface'
        ]);
        $this->callSilent('module-generator:repository', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::REPOSITORY_DIR . '\\' . Config::IMPL_DIR . '\\' . $moduleName .'Repository'
        ]);
        $this->callSilent('module-generator:service', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::SERVICE_DIR . '\\' . Config::IMPL_DIR . '\\' . $moduleName .'Service'
        ]);
        $this->callSilent('module-generator:serviceInterface', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::SERVICE_DIR . '\\' . $moduleName .'ServiceInterface'
        ]);
        $this->callSilent('module-generator:module', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . $moduleName . 'Module'
        ]);
        $this->callSilent('module-generator:moduleInterface', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . $moduleName . 'ModuleInterface'
        ]);
        $this->callSilent('module-generator:provider', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::PROVIDER_DIR . '\\' . $moduleName .'Provider'
        ]);
        $this->callSilent('module-generator:transformer', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::TRANSFORMER_DIR . '\\' . $moduleName .'Transformer'
        ]);
        $this->callSilent('module-generator:model', [
            'name' =>  $this->getModulePath($moduleName) . '\\' . Config::MODEL_DIR . '\\' . $moduleName
        ]);
        $this->callSilent('module-generator:trait-in', [
            'name' => $this->getModulePath($moduleName) . '\\' . $moduleName . 'InTrait'
        ]);
        $this->callSilent('module-generator:trait-out', [
            'name' => $this->getModulePath($moduleName) . '\\' . $moduleName . 'OutTrait'
        ]);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }


    private function makeModuleDirPath($moduleName)
    {
        if ($this->files->isDirectory($this->getBlockPath(Config::MODULE_DIR . '/' . $moduleName))) {
            $this->info($moduleName . ' module exists!');exit();
        }
        foreach ($this->getBlockPathList() as $block) {
            $this->makeDirPath($this->getBlockPath(Config::MODULE_DIR . '/' . $moduleName) . '/' . $block);
        }
    }

    private function getBlockPathList()
    {
        return [
            Config::MODEL_DIR,
            Config::CONF_DIR,
            Config::PROVIDER_DIR,
            Config::REPOSITORY_DIR,
            Config::REPOSITORY_DIR . '/' . Config::IMPL_DIR,
            Config::SERVICE_DIR,
            Config::SERVICE_DIR . '/' . Config::IMPL_DIR,
            Config::TRANSFORMER_DIR,
        ];
    }

    private function getBlockPath($block)
    {
        return $this->laravel['path'] . '/' . $block;
    }

    private function makeDirPath($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
    }

    /**
     * @param $moduleName
     *
     * @return string
     */
    private function getModulePath($moduleName)
    {
        return Config::MODULE_DIR . '\\' . $moduleName;
    }
}