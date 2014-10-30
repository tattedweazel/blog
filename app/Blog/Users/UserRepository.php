<?php namespace Blog\Users;


class UserRepository {

	/**
	 * Persist
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function save(User $user){

		return $user->save();

	}
} 