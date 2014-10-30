<?php namespace Blog\Users\Forms;

use Laracasts\Validation\FormValidator;

class PasswordUpdateForm extends FormValidator{
	protected $rules = [
		"password" => "required|min:6|confirmed",
	];
}