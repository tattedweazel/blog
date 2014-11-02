<?php namespace Blog\Categories;

class Category extends \Eloquent {
	protected $table = 'category';
	protected $fillable = ['label'];

	public function article(){
		return $this->hasMany('Blog\Articles\Article');
	}

	public function getDates()
	{
		return array('created_at', 'updated_at');
	}
}