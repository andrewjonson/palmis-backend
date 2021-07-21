<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ApiServiceControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:api-service-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new api service controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

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
        $stub = '../../stubs/api-service-controller.stub';
        if ($this->option('references')) {
            $stub = '../../stubs/api-service-controller-reference.stub';
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
        return $rootNamespace.'\\Http\\Controllers\\ApiService\\'.config('app.version');
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
        $name = Str::replaceArray('/', ['\\'], $name);
        $name = Str::replaceArray('Controller', [''], $name);
        $module = Str::replaceArray('Service\\References/'.class_basename($name), [''], $name);

        return array_merge($replace, [
            'DummyModuleLowerClass' => Str::lower($module),
            'DummyAppVersion' => config('app.version'),
            'DummyModulePluralClass' => Str::plural(Str::lower(class_basename($name))),
            'DummyApiServiceNamespace' => $name,
            'DummyApiServiceClass' => class_basename($name)
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
            ['references', null, InputOption::VALUE_NONE, 'Create a plain api service class'],
        ];
    }
}