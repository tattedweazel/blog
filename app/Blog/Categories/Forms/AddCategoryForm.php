<?php namespace Blog\Categories\Forms;

use Laracasts\Validation\FormValidator;

class AddCategoryForm extends FormValidator{
	protected $rules = [
		"label" => "required|unique:category"
	];
}