<?php namespace Blog\Users\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		"email" => "required|email|unique:users",
		"name" => "required|unique:users",
		"password" => "required|confirmed"
	];

} 