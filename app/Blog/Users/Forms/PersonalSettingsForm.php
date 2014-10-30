<?php namespace Blog\Users\Forms;

use Laracasts\Validation\FormValidator;

class PersonalSettingsForm extends FormValidator{
	protected $rules = [
		"email" => "required",
		"name" => "required",
	];
}