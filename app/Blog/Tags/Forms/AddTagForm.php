<?php namespace Blog\Tags\Forms;

use Laracasts\Validation\FormValidator;

class AddTagForm extends FormValidator{
	protected $rules = [
		"label" => "required|unique:tags"
	];
}