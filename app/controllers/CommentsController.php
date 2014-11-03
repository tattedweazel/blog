<?php

use Blog\Comments\Comment;
use Blog\Comments\CommentAction;

class CommentsController extends \BaseController {

	const REPORT_THRESHOLD = 10;

	public function add($slug)
	{
		$formData = Input::only('body');
		$currentUser = Auth::user();
		$article = \Blog\Articles\Article::where('slug', '=', $slug)->first();
		if (! $article){
			return Redirect::back();
		}
		$comment = new Comment;
		$comment->body = $formData['body'];
		$comment->article_id = $article->id;
		$comment->user_id = $currentUser->id;
		$comment->save();
		$this->logAction($comment->id, $currentUser->id, 'added');

		return Redirect::back();
	}

	public function destroy($id)
	{

	}

	public function enable($id)
	{
		$currentUser = Auth::user();
		$comment = Comment::find($id);

		if (!$currentUser->canModerate()){
			return Redirect::back();
		}

		$comment->disabled = 0;
		$comment->save();
		$this->logAction($comment->id, $currentUser->id, 're-enable');

		return Redirect::back();
	}

	public function disable($id, $auto = false)
	{
		$currentUser = Auth::user();
		$comment = Comment::find($id);

		if (!$currentUser->canModerate() && !$auto){
			return Redirect::back();
		}

		$comment->disabled = 1;
		$comment->save();
		if (!$auto){
			$this->logAction($comment->id, $currentUser->id, 'disable');
		}

		return Redirect::back();
	}

	public function upvote($id)
	{
		$currentUser = Auth::user();
		$comment = Comment::find($id);

		if ($comment->user_id == $currentUser->id){
			return Redirect::back();
		}

		if ($previousUpvote = $comment->checkForPrevious($currentUser->id, 'upvote')){
				return Redirect::back(); // You've already done this..
		}
		if ($currentUser){
			if ($previousDownvote = $comment->checkForPrevious($currentUser->id, 'downvote')){
				$previousDownvote->delete();
				$comment->score = $comment->score + 2;
			}
			else {
				$comment->score = $comment->score + 1;
			}
			$comment->save();
			$this->logAction($comment->id, $currentUser->id, 'upvote');
		}

		return Redirect::back();
	}

	public function downvote($id)
	{
		$currentUser = Auth::user();
		$comment = Comment::find($id);

		if ($previousDownvote = $comment->checkForPrevious($currentUser->id, 'downvote')){
			return Redirect::back(); // You've already done this..
		}
		if ($currentUser){
			if ($previousUpvote = $comment->checkForPrevious($currentUser->id, 'upvote')){
				$previousUpvote->delete();
				$comment->score = $comment->score - 2;
			}
			else {
				$comment->score = $comment->score - 1;
			}

			$comment->save();
			$this->logAction($comment->id, $currentUser->id, 'downvote');
		}

		return Redirect::back();
	}

	public function report($id)
	{
		$currentUser = Auth::user();
		$comment = Comment::find($id);
		if ($currentUser && !$comment->userHasReported($currentUser->id)){
			$comment->reports = $comment->reports + 1;
			if ($comment->reports >= self::REPORT_THRESHOLD){
				$this->disable($id, true);
				$this->logAction($comment->id, $currentUser->id, 'auto-disable');
			}
			$comment->save();
			$this->logAction($comment->id, $currentUser->id, 'report');
		}

		return Redirect::back();
	}

	private function logAction($commentId, $userId, $action)
	{
		if ($commentId && $userId && $action) {
			$commentAction = new CommentAction;
			$commentAction->comment_id = $commentId;
			$commentAction->user_id = $userId;
			$commentAction->action = $action;
			$commentAction->save();
		}
	}

}