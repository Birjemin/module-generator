<?php

namespace Birjemin\ModuleGenerator\Provider;


use Birjemin\ModuleGenerator\Console\BaseMakeCommand;
use Birjemin\ModuleGenerator\Console\ModelMakeCommand;
use Birjemin\ModuleGenerator\Console\ModuleGeneratorCommand;
use Birjemin\ModuleGenerator\Console\ModuleInterfaceMakeCommand;
use Birjemin\ModuleGenerator\Console\ModuleMakeCommand;
use Birjemin\ModuleGenerator\Console\ProviderMakeCommand;
use Birjemin\ModuleGenerator\Console\RepositoryInterfaceMakeCommand;
use Birjemin\ModuleGenerator\Console\RepositoryMakeCommand;
use Birjemin\ModuleGenerator\Console\ServiceInterfaceMakeCommand;
use Birjemin\ModuleGenerator\Console\ServiceMakeCommand;
use Birjemin\ModuleGenerator\Console\TraitInMakeCommand;
use Birjemin\ModuleGenerator\Console\TraitOutMakeCommand;
use Birjemin\ModuleGenerator\Console\TransformerMakeCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class ModuleMakeServiceProvider
 * @package Birjemin\ModuleGenerator\Provider
 */
class ModuleMakeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModuleMakeCommand();
        $this->registerRepositoryCommand();
        $this->registerServiceCommand();
        $this->registerModuleCommand();
        $this->registerProviderCommand();
        $this->registerTransformerCommand();
        $this->registerModelCommand();
        $this->registerBaseCommand();
        $this->registerTraitCommand();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // base
            'command.module-generator.make.base',
            // module
            'command.module-generator.module',
            'command.module-generator.make.repository',
            'command.module-generator.make.repository.interface',
            'command.module-generator.make.service',
            'command.module-generator.make.service.interface',
            'command.module-generator.make.module',
            'command.module-generator.make.module.interface',
            'command.module-generator.make.provider',
            'command.module-generator.make.transformer',
            'command.module-generator.make.model',
            'command.module-generator.make.trait.in',
            'command.module-generator.make.trait.out',
        ];
    }

    /**
     * Register the documentation command.
     *
     * @return void
     */
    protected function registerModuleMakeCommand()
    {
        $this->app->singleton('command.module-generator.generator.module', function($app) {
            return new ModuleGeneratorCommand($app['files']);
        });

        $this->commands(['command.module-generator.generator.module']);
    }

    /**
     * Register the module command
     */
    protected function registerModuleCommand()
    {
        $this->app->singleton('command.module-generator.make.module', function($app) {
            return new ModuleMakeCommand($app['files']);
        });
        $this->app->singleton('command.module-generator.make.module.interface', function($app) {
            return new ModuleInterfaceMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.module']);
        $this->commands(['command.module-generator.make.module.interface']);
    }

    /**
     * Register the repository command
     */
    protected function registerRepositoryCommand()
    {
        $this->app->singleton('command.module-generator.make.repository', function($app) {
            return new RepositoryMakeCommand($app['files']);
        });
        $this->app->singleton('command.module-generator.make.repository.interface', function($app) {
            return new RepositoryInterfaceMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.repository']);
        $this->commands(['command.module-generator.make.repository.interface']);
    }

    /**
     * Register the repository command
     */
    protected function registerServiceCommand()
    {
        $this->app->singleton('command.module-generator.make.service', function($app) {
            return new ServiceMakeCommand($app['files']);
        });
        $this->app->singleton('command.module-generator.make.service.interface', function($app) {
            return new ServiceInterfaceMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.service']);
        $this->commands(['command.module-generator.make.service.interface']);
    }


    /**
     * Register the provider command
     */
    protected function registerProviderCommand()
    {
        $this->app->singleton('command.module-generator.make.provider', function($app) {
            return new ProviderMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.provider']);
    }

    /**
     * Register the transformer command
     */
    protected function registerTransformerCommand()
    {
        $this->app->singleton('command.module-generator.make.transformer', function($app) {
           return new TransformerMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.transformer']);
    }

    /**
     * Register the model command
     */
    protected function registerModelCommand()
    {
        $this->app->singleton('command.module-generator.make.model', function($app) {
            return new ModelMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.model']);
    }

    /**
     * Register the base command
     */
    protected function registerBaseCommand()
    {
        $this->app->singleton('command.module-generator.make.base', function($app) {
            return new BaseMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.base']);
    }

    /**
     * Register the trait command
     */
    protected function registerTraitCommand()
    {
        $this->app->singleton('command.module-generator.make.trait.in', function($app) {
            return new TraitInMakeCommand($app['files']);
        });
        $this->app->singleton('command.module-generator.make.trait.out', function($app) {
            return new TraitOutMakeCommand($app['files']);
        });

        $this->commands(['command.module-generator.make.trait.in']);
        $this->commands(['command.module-generator.make.trait.out']);
    }
}
