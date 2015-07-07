<?php

namespace Socieboy\Chat;

use Illuminate\Support\ServiceProvider;
use Socieboy\Chat\Commands\MigrateChatCommand;

class ChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishFiles();

        $this->loadViewsFrom(__DIR__.'/Views', 'Chat');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bindShared('command.chat.table', function ($app) {
            return new MigrateChatCommand();
        });

        $this->commands('command.chat.table');

        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/routes.php';
        }


    }

    protected function publishFiles()
    {
        $this->publishes([

            // Publish config file
            __DIR__.'/Config/chat.php' => base_path('config/chat.php'),

            // Publish css style
            __DIR__.'/Scripts/css/chat.css' => base_path('public/css/chat.css'),

            // Publish js script
            __DIR__.'/Scripts/js/chat.js' => base_path('public/js/chat.js'),
            __DIR__.'/Scripts/js/socket.io.js' => base_path('public/js/socket.io.js'),

        ]);
    }
}
