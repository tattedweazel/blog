<?php namespace Blog\Articles\Forms;

use Laracasts\Validation\FormValidator;

class EditArticleForm extends FormValidator{
	protected $rules = [
		"title" => "required",
		"body" => "required|min:20"
	];
}