<?php namespace Blog\Tags;

class Tag extends \Eloquent {
	protected $table = 'tags';
	protected $fillable = ['label'];

	public function articles(){
		return $this->belongsToMany('Blog\Articles\Article');
	}

	public function getDates()
	{
		return array('created_at', 'updated_at');
	}
}