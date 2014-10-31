<?php namespace Blog\Articles\Forms;

use Laracasts\Validation\FormValidator;

class NewArticleForm extends FormValidator{
	protected $rules = [
		"title" => "required|unique:articles",
		"body" => "required|min:20"
	];
}