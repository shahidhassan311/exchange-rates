<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Get all PHP files in the repositories directory
        $repositoryFiles = File::glob(app_path('Repositories/Eloquent/*.php'));
        // dd($repositoryFiles)

        // Bind each repository interface to its corresponding Eloquent implementation
        foreach ($repositoryFiles as $file) {
            $filename = basename($file, '.php');

            $interface = "App\\Repositories\\Interfaces\\{$filename}Interface";
            $implementation = "App\\Repositories\\Eloquent\\{$filename}";

            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
