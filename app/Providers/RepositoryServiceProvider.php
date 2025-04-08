<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $interfacePath = app_path('Interfaces');
        $repositoryPath = app_path('Repositories');

        foreach (glob($interfacePath . '/*.php') as $interfaceFile) {
            $interface = 'App\\Interfaces\\' . basename($interfaceFile, '.php');
            $className = Str::replaceLast('Interface', '', class_basename($interface));
            $repository = 'App\\Repositories\\' . $className;

            if (interface_exists($interface) && class_exists($repository)) {
                $this->app->bind($interface, $repository);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
