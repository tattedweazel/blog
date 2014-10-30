<?php namespace Blog\Activities;

class Activity extends \Eloquent {

	protected $table = 'activities';
	protected $fillable = ['user_id', 'action', 'meta'];

	public function user(){
		return $this->hasOne('Blog\Users\User');
	}

	public function getDates()
	{
		return array('created_at');
	}

}