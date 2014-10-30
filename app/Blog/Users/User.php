<?php namespace Blog\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Eloquent, Hash;
use Laracasts\Commander\Events\EventGenerator;
use Blog\Users\Events\UserSignedUp;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['name', 'email', 'type', 'password'];

	public function setPasswordAttribute($password){
		$this->attributes['password'] = Hash::make($password);
	}

	public static function signUp($name, $email, $type, $password){

		$user = new static(compact('name', 'email', 'type', 'password'));

		$user->raise(new UserSignedUp($user));

		return $user;
	}

}
