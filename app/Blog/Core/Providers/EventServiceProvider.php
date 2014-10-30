<?php namespace Blog\Core\Providers;


use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['events']->listen('Blog.*', 'Blog\Core\Handlers\ActivityTracker');
	}
}