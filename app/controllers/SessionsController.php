<?php

use Blog\Users\Events\UserLoggedIn;
use Blog\Users\Events\UserLoggedOut;
use Blog\Users\Forms\SignInForm;
use Laracasts\Commander\Events\DispatchableTrait;

class SessionsController extends BaseController {

	use DispatchableTrait;

	/**
	 * @var SignInForm
	 */
	private $signInForm;

	public function __construct(SignInForm $signInForm){

		$this->signInForm = $signInForm;
	}

	public function index(){
		return View::make('pages.account.login')
			->withSectionTitle('Log In');
	}


	public function store(){
		$formData = Input::only('email', 'password');

		$this->signInForm->validate($formData);
		if (Auth::attempt($formData)){
			$user = Auth::user();
			$user->raise(new UserLoggedIn($user));
			$this->dispatchEventsFor($user);
			return Redirect::intended('/');
		}
		else {
			Flash::error('Incorrect email or password');
			return Redirect::home()->withInput()->withErrors('Incorrect email or password');
		}
	}

	public function destroy()
	{
		$user = Auth::user();
		$user->raise(new UserLoggedOut($user));
		$this->dispatchEventsFor($user);
		Auth::logout();

		return Redirect::home();
	}
} 