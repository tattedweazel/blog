<?php namespace Blog\Users;


class UserSignUpCommand {

	public $name;
	public $email;
	public $password;

	function __construct($name, $email, $password)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}


} 