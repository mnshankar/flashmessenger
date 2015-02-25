<?php namespace mnshankar\Flash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'mnshankar\Flash\SessionStore',
            'mnshankar\Flash\LaravelSessionStore'
        );

        $this->app->bindShared('flash', function () {
            return \App::make('mnshankar\Flash\FlashNotifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //fix for psr-4
        $this->package('mnshankar/flashmessenger',null, __DIR__);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('flash');
    }

}
