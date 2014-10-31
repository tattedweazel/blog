<?php namespace Blog\Articles;

use Eloquent;

class Article extends Eloquent {

	protected $table = 'articles';
	protected $fillable = ['title', 'sub_title', 'body', 'user_id'];

	public function user(){
		return $this->belongsTo('Blog\Users\User');
	}

	public function getDates()
	{
		return array('created_at');
	}

	public function generateSlug($title)
	{
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
		if (substr($slug, -1) == '-'){
			$slug = substr($slug, 0, -1);
		}
		return strtolower($slug);
	}
} 