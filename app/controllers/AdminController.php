<?php

use Blog\Users\User;

class AdminController extends \BaseController {

	public function index()
	{
		if (! $this->adminCheck()){
			return Redirect::home();
		}

		$users = User::all();

		return View::make('pages.admin.users')
			->withSectionTitle('Admin')
			->withUsers($users);
	}

	private function adminCheck(){
		$currentUser = Auth::user();
		if ($currentUser->canAdmin()){
			return true;
		}
		return false;
	}

}