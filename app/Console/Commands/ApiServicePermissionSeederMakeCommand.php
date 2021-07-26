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
    protected $name = 'make:api-service-permission-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder';

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

        if ($this->option('references')) {
            $this->createReferenceController();
        } else {
            $this->createController();
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '../../stubs/api-service.stub';
        if ($this->option('references')) {
            $stub = '../../stubs/api-service-reference.stub';
        }

        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Services\\ApiService\\'.config('app.version');
    }

    protected function createReferenceController()
    {
        $controller = Str::studly($this->argument('name'));
        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:api-service-controller', array_filter([
            'name'  => "{$controller}Controller",
            '--references' => $modelName
        ]));
    }

    protected function createController()
    {
        $controller = Str::studly($this->argument('name'));

        $this->call('make:api-service-controller', array_filter([
            'name'  => "{$controller}Controller"
        ]));
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

        $replace = $this->buildApiServiceReplacements($replace);

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
    protected function buildApiServiceReplacements(array $replace)
    {
        $name = Str::replaceArray('/', ['\\'], $this->argument('name'));
        $module = Str::replaceArray('Service\\References/'.class_basename($name), [''], $name);

        return array_merge($replace, [
            'DummyModuleLowerClass' => Str::lower($module),
            'DummyAppVersion' => config('app.version'),
            'DummyModulePluralClass' => Str::plural(Str::lower(class_basename($name)))
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
            ['controller', null, InputOption::VALUE_NONE, 'Generate an api service controller'],
            ['references', 'r', InputOption::VALUE_NONE, 'Create a plain api service class'],
        ];
    }
}