<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use ReflectionClass;
use Illuminate\Support\Str;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repository bindings by scanning all classes in
     * app/Repositories and binding any App\Interfaces\* interface
     * they implement.
     */
    public function register(): void
    {
        $baseNamespace     = 'App';
        $interfaceBasePath = app_path('Interfaces');
        $repositoryBasePath = app_path('Repositories');

        // Step 1: Gather all interfaces under app/Interfaces (recursively)
        $allInterfaces = $this->getClassMap($interfaceBasePath, $baseNamespace . '\\Interfaces');

        // Step 2: Gather all repository classes under app/Repositories (recursively)
        $allRepositories = $this->getClassMap($repositoryBasePath, $baseNamespace . '\\Repositories');

        // Step 3: For each repository class, reflect on its implemented interfaces
        foreach ($allRepositories as $repoClass) {
            if (! class_exists($repoClass)) {
                continue;
            }

            $ref = new ReflectionClass($repoClass);
            if ($ref->isAbstract() || $ref->isInterface()) {
                continue;
            }

            // Get all interfaces this class implements
            $implemented = $ref->getInterfaceNames();

            foreach ($implemented as $iface) {
                // Only bind interfaces that live in App\Interfaces
                if (
                    Str::startsWith($iface, $baseNamespace . '\\Interfaces\\')
                    && in_array($iface, $allInterfaces, true)
                ) {
                    // Bind the interface to this repository
                    $this->app->bind($iface, $repoClass);
                }
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // no-op
    }

    /**
     * Recursively scan a given directory for PHP class files and build a
     * “fully qualified classname → filepath” map.
     *
     * @param  string  $dir          The filesystem path to scan
     * @param  string  $namespace    The base namespace that corresponds to $dir
     * @return array                 A plain array of fully qualified class names
     */
    protected function getClassMap(string $dir, string $namespace): array
    {
        $classes = [];

        // Set up a recursive iterator to find all “*.php” files
        $directoryIterator = new RecursiveDirectoryIterator($dir);
        $iterator = new RecursiveIteratorIterator($directoryIterator);
        $phpFiles = new RegexIterator($iterator, '/^.+\.php$/i', RegexIterator::GET_MATCH);

        foreach ($phpFiles as $fileInfo) {
            $filePath = $fileInfo[0];

            // Derive “App\...” style class name from the file path:
            // 1) Remove the base path, 2) strip “.php”, 3) convert directory separators to “\”
            $relativePath = Str::after($filePath, $dir . DIRECTORY_SEPARATOR);
            $className    = $namespace . '\\' . str_replace(
                [DIRECTORY_SEPARATOR, '.php'],
                ['\\', ''],
                $relativePath
            );

            $classes[] = $className;
        }

        return $classes;
    }
}
