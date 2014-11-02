<?php

use Blog\Categories\Category;

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		// Used ... like... everywhere
		View::share('current_user', Auth::user());

		// Used in Title block of default layout
		View::share('site_name', getenv('SITE_NAME'));

		// Used in Main Header for Nav
		$categories = Category::all();
		View::share('categories', $categories);
	}

}
