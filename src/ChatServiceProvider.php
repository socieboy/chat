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
}
