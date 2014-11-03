<?php namespace Blog\Comments;

use Blog\Comments\CommentAction;

class Comment extends \Eloquent {
	protected $table = 'comments';
	protected $fillable = ['body'];

	public function article()
	{
		return $this->belongsTo('Blog\Articles\Article');
	}

	public function user()
	{
		return $this->belongsTo('Blog\Users\User');
	}

	public function comment_actions()
	{
		return $this->hasMany('Blog\Comments\CommentActions');
	}

	public function getDates()
	{
		return array('created_at', 'updated_at');
	}

	public function disabledText()
	{
		return '[This comment has been disabled. If you are the author and are unsure as to why, please contact a Moderator.]';
	}

	public function userHasVoted($userId)
	{
		$previousUpvote = $this->checkForPrevious($userId, 'upvote');
		$previousDownvote = $this->checkForPrevious($userId, 'downvote');

		return ($previousUpvote || $previousDownvote);
	}

	public function userHasUpvoted($userId)
	{
		$previousUpvote = $this->checkForPrevious($userId, 'upvote');

		return ($previousUpvote);
	}

	public function userHasDownvoted($userId)
	{
		$previousDownvote = $this->checkForPrevious($userId, 'downvote');

		return ($previousDownvote);
	}

	public function userHasReported($userId)
	{
		$previousReport = $this->checkForPrevious($userId, 'report');

		return ($previousReport);
	}

	public function checkForPrevious($userId, $action)
	{
		return CommentAction::where('comment_id', '=', $this->id)
			->where('user_id', '=', $userId)
			->where('action', '=', $action)
			->first();
	}

	public function userOwnsComment($userId){
		return $this->user_id == $userId;
	}
}