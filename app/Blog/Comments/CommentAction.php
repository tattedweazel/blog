<?php namespace Blog\Comments;

class CommentAction extends \Eloquent {
	protected $table = 'comment_actions';
	protected $fillable = [];

	public function comment()
	{
		return $this->belongsTo('Blog\Comments\Comment');
	}

	public function user()
	{
		return $this->belongsTo('Blog\Users\User');
	}

	public function getDates()
	{
		return array('created_at', 'updated_at');
	}
}