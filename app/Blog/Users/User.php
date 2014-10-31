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

	public function canAdmin(){
		return ($this->type == 'Admin');
	}

	public function canWrite(){
		switch($this->type){
			case 'Admin':
			case 'Author':
				return true;
				break;
			default:
				return false;
		}
	}

	public function canModerate(){
		switch($this->type){
			case 'Admin':
			case 'Author':
			case 'Mod':
				return true;
			break;
			default:
				return false;
		}
	}

	public function privsMessage(){
		switch ($this->type){
			case 'Admin':
				$msg = 'You are an Admin. YAY!';
				break;
			case 'Author':
				$msg = 'You are an Author. Woot!';
				break;
			case 'Mod':
				$msg = 'You are a Moderator. Neat!';
				break;
			case 'User':
			default:
				$msg = '';
				break;
		}
		return $msg;

	}

}
