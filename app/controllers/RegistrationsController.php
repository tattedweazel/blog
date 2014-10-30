<?php

use Blog\Users\Forms\RegistrationForm;
use Blog\Core\Traits\CommandBus;
use Blog\Users\User;
use Blog\Users\UserSignUpCommand;

class RegistrationsController extends \BaseController {

	use CommandBus;

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;

	function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;
	}

	public function index(){
		return View::make('pages.account.signup')
			->withSectionTitle('Sign Up');
	}

	public function store()
	{
		$formData = Input::all();
		$this->registrationForm->validate($formData);

		extract(Input::only('name', 'email', 'password'));

		$user = $this->execute(
			new UserSignUpCommand($name, $email, $password)
		);

		// Log the newly created user in
		Auth::login($user);
		return Redirect::home();
	}


}