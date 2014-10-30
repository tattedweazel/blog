<?php namespace Blog\Core\Handlers;

use Laracasts\Commander\Events\EventListener;
use Blog\Users\Events\UserLoggedIn;
use Blog\Users\Events\UserLoggedOut;
use Blog\Users\Events\UserSignedUp;
use Blog\Activities\Activity;

class ActivityTracker extends EventListener{

	public function whenUserSignedUp(UserSignedUp $event){
		$user = $event->user;
		$this->logEvent($user, 'New Sign Up', $user->email);
	}

	public function whenUserLoggedIn(UserLoggedIn $event){
		$user = $event->user;
		$this->logEvent($user, 'User Logged In', $user->email);

	}

	public function whenUserLoggedOut(UserLoggedOut $event){
		$user = $event->user;
		$this->logEvent($user, 'User Logged Out', $user->email);

	}

	private function logEvent($user, $action, $meta=""){
		$activity = new Activity();
		$activity->user_id = $user->id;
		$activity->action = $action;
		$activity->meta = $meta;
		$activity->save();
	}
} 