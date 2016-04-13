<?php namespace ETrans;

use Carbon\Carbon;
use Elicit\ETrans\Commands\ETransInstall;
use Illuminate\Support\ServiceProvider AS Default_ServiceProvider;

/**
 * ETrans, package for installing and updating translations.
 * Run "php artisan etrans:install" to download the desired translation files.
 *
 * @package Elicit\ETrans
 */
class ServiceProvider extends Default_ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config' => config_path(),
        ]);
    }

    protected $commands = [
        ETransInstall::class
    ];

    public function register()
    {
        $this->commands($this->commands);
    }
}