<?php namespace Orkhan\Laraphrases;

use Illuminate\Support\ServiceProvider;

class LaraphrasesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('orkhan/laraphrases');

        include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $app = $this->app;

        $this->registerHelpers($app);

        $this->registerModels($app);

        $this->registerEvents($app);

        $this->registerCommands($app);
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

    /**
     * Register helpers
     *
     * @param $app
     *
     * @return void
     */
    private function registerHelpers($app)
    {
        $app['laraphrase'] = $app->share(function () {
            return new \Orkhan\Laraphrases\Helpers\Laraphrase();
        });
    }

    /**
     * Register models
     *
     * @param $app
     *
     * @return void
     */
    private function registerModels($app)
    {
        $app['phrase'] = $app->share(function () {
            return new \Orkhan\Laraphrases\Models\Phrase();
        });
    }
	
    /**
     * Register events
     *
     * @param $app
     *
     * @return void
     */
    private function registerEvents($app)
    {
        $app['events']->listen('eloquent.updating*', function ($model) use ($app) {
            if ( $model instanceof \Orkhan\Laraphrases\Models\Phrase ) $model->versionIt();
        });
    }

    /**
     * Register commands
     *
     * @param $app
     *
     * @return void
     */
    private function registerCommands($app)
    {
        $app['laraphrase::install'] = $app->share(function($app)
        {
            return new \Orkhan\Laraphrases\Commands\LaraphraseCommand;
        });

        $this->commands('laraphrase::install');
    }

}
