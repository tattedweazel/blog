<?php

use Blog\Users\Forms\PasswordUpdateForm;
use Blog\Users\Forms\PersonalSettingsForm;
use Blog\Users\User;

class AccountController extends \BaseController {

	/**
	 * @var PasswordUpdateForm
	 */
	private $passwordUpdateForm;
	/**
	 * @var PersonalSettingsForm
	 */
	private $personalSettingsForm;

	public function __construct(PasswordUpdateForm $passwordUpdateForm, PersonalSettingsForm $personalSettingsForm)
	{
		$this->passwordUpdateForm = $passwordUpdateForm;
		$this->personalSettingsForm = $personalSettingsForm;
	}
	public function show($id)
	{
		$account = User::find($id);
		if ( ! $this->canEdit(Auth::user(), $account) ){
			return Redirect::home();
		}
		$articles = $account->articles;
		$comments = $account->comments;
		return View::make('pages.account.info')
			->withSectionTitle($account->name)
			->withAccount($account)
			->withArticles($articles)
			->withComments($comments);
	}

	public function update($id)
	{
		$formData = Input::all();
		$this->personalSettingsForm->validate($formData);

		$account = User::find($id);
		if ( ! $this->canEdit(Auth::user(), $account) ){
			return Redirect::home();
		}
		$save = false;
		if ($account->name != $formData['name']){
			$nameCheck = User::where('name', '=', $formData['name'])->first();
			if ($nameCheck && $nameCheck->id != $account->id){
				return Redirect::back()->withErrors('Username "'.$formData['name'].'" is already in use');
			}
			$save = true;
			$account->name = $formData['name'];
		}
		if ($account->email != $formData['email']){
			$emailCheck = User::where('email', '=', $formData['email'])->first();
			if ($emailCheck && $emailCheck->id != $account->id){
				return Redirect::back()->withErrors('That Email is already in use');
			}
			$save = true;
			$account->email = $formData['email'];
		}

		if ($save){
			$account->save();
		}

		return Redirect::back();
	}

	public function updatePassword($id)
	{
		$formData = Input::all();
		$this->passwordUpdateForm->validate($formData);

		$account = User::find($id);
		if ( ! $this->canEdit(Auth::user(), $account) ){
			return Redirect::home();
		}

		$account->password = $formData['password'];
		$account->save();

		return Redirect::back();
	}

	public function updateType($id)
	{
		$account = User::find($id);
		if ( ! $this->canDelete(Auth::user(), $account) ){
			return Redirect::back()->withErrors('Unable to Update User Type');
		}

		$formData = Input::only('type');
		$account->type = $formData['type'];
		$account->save();

		return Redirect::back();
	}

	public function destroy($id)
	{
		$account = User::find($id);
		if ( ! $this->canDelete(Auth::user(), $account) ){
			return Redirect::back()->withErrors('Unable to Delete User');
		}

		$account->delete();
		return Redirect::route('user_admin_path');
	}

	public function canEdit($currentUser, $account){
		return ( ( $currentUser->id == $account->id ) || ( $currentUser->type == 'Admin' ) );
	}

	public function canDelete($currentUser, $account){
		return ( ( $currentUser->id != $account->id ) && ( $currentUser->type == 'Admin' ) );
	}

}