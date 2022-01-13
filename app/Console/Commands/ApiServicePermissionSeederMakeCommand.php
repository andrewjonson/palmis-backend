<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ApiServicePermissionSeederMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:api-service-permission-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new permissions seeder';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '../../stubs/api-service-permission-seeder.stub';

        return __DIR__ . $stub;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $modelClass = Str::replaceArray('App', [''], $this->argument('name'));
        return $this->laravel->basePath('database').'/seeders/ApiService/'.config('app.version').'/'.$modelClass.'.php';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $replace = [];

        $replace = $this->buildReplacements($replace);

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildReplacements(array $replace)
    {
        $name = Str::replaceArray('/', ['\\'], $this->argument('name'));
        $seeder = Str::replaceArray('/'.class_basename($name), [''], $name);
        $baseName = Str::replaceArray('PermissionsTableSeeder', [''], class_basename($name));
        $moduleName = Str::replaceArray('Service\\Transactions/'.class_basename($name), [''], $name);
        if ($this->option('references')) {
            $moduleName = Str::replaceArray('Service\\References/'.class_basename($name), [''], $name);
        }

        return array_merge($replace, [
            'DummyAppVersion' => config('app.version'),
            'DummySeederNamespace' => $seeder,
            'DummyNameLower' => Str::lower($baseName),
            'DummyNameStudly' => Str::studly($baseName),
            'DummyModuleLowerClass' => Str::lower($moduleName)
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['references', 'r', InputOption::VALUE_NONE, 'Create a plain api service class'],
        ];
    }
}