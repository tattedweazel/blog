<?php namespace Blog\Users;


use Blog\Users\UserRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Blog\Users\User;

class UserSignUpCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $repository;

	function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$user = User::signUp($command->name, $command->email, 'User', $command->password);

		$this->repository->save($user);
		$this->dispatchEventsFor($user);

		return $user;
	}
}