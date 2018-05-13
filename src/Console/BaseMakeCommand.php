<?php

/**
 * Created by PhpStorm.
 * User: birjemin
 * Date: 09/05/2018
 * Time: 12:35 AM
 */
namespace Birjemin\ModuleGenerator\Console;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class BaseMakeCommand
 * @package Birjemin\ModuleGenerator\Console
 */
class BaseMakeCommand  extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module-generator:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy base file';

    /** @var  \Illuminate\Filesystem\Filesystem $files */
    private $files;

    /**
     * BaseMakeCommand constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->makeDirPath();
        $this->info('module base dir generated successfully!');
    }

    private function makeDirPath()
    {
        $path = $this->laravel['path'] . '/Base';
        if (!$this->files->isDirectory($path)) {
            $this->files->copyDirectory(__DIR__ . '/../Base', $path);
            $this->files->makeDirectory($path, 0777, true, true);
            foreach ($this->files->allFiles($path) as $file) {
                /** @var SplFileInfo $file */
                $this->files->move($path . '/' . $file->getRelativePathname(), $path . '/' . $file->getRelativePathname() . '.php');
            }
        }
    }
}