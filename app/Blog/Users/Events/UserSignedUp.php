<?php namespace Blog\Users\Events;


use Blog\Users\User;

class UserSignedUp {

	/**
	 * @var
	 */
	public $user;

	/**
	 * @param $user
	 */
	function __construct(User $user)
	{
		$this->user = $user;
	}
}