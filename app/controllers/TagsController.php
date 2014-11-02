<?php

use Blog\Articles\Article;
use Blog\Tags\Forms\AddTagForm;
use Blog\Tags\Tag;

class TagsController extends \BaseController {

	private $addTagForm;

	public function __construct(AddTagForm $addTagForm)
	{
		$this->addTagForm = $addTagForm;
	}

	public function index()
	{
		$tags = Tag::orderBy('label', 'asc')->get();

		return View::make('pages.admin.tags')
			->withSectionTitle('Tags')
			->withTags($tags);
	}

	public function add()
	{
		$currentUser = Auth::user();
		$formData = Input::only('label');
		$this->addTagForm->validate($formData);
		$tag = new Tag($formData);

		if ($currentUser->canWrite()){
			$tag->save();
		}

		return Redirect::back();

	}

	public function update($id)
	{
		$currentUser = Auth::user();
		$tag = Tag::find($id);
		$formData = Input::only('label');
		if ($tag->label != $formData['label']){
			$this->addTagForm->validate($formData);
			$tag->label = $formData['label'];
			if ($currentUser->canWrite()){
				$tag->save();
			}
		}

		return Redirect::back();

	}

	public function filter($label)
	{
		$currentUser = Auth::user();
		$tag = Tag::where('label', '=', $label)->first();
		$articles = $tag->articles();
		if (!$tag){
			return Redirect::home();
		}
		if ($currentUser){
			$articles = $articles->orderBy('updated_at', 'desc')->get();
		}
		else {
			$articles = $articles->where('public','=',1)->orderBy('updated_at', 'desc')->get();
		}

		return View::make('pages.articles.filtered')
			->withSectionTitle($tag->label)
			->withHeading($tag->label)
			->withArticles($articles);
	}

	public function attach($tagId, $articleId){
		$currentUser = Auth::user();

		$article = Article::find($articleId);
		$tag = Tag::find($tagId);
		$currentTags = $article->tags->toArray();
		$alreadyHasTag = false;
		foreach ($currentTags as $currentTag){
			if ($tag->id == $currentTag['id']){
				$alreadyHasTag = true;
			}
		}
		if (! $alreadyHasTag && $article && $currentUser->canWrite()){
			$article->tags()->attach($tagId);
		}


		echo json_encode(['success' => 1]);
	}

	public function detach($tagId, $articleId){
		$currentUser = Auth::user();

		$article = Article::find($articleId);
		if ($article && $currentUser->canWrite()){
			$article->tags()->detach($tagId);
		}

		return Redirect::back();
	}

	public function destroy($id)
	{
		$currentUser = Auth::user();
		if ($currentUser->canWrite()){
			Tag::destroy($id);
		}

		return Redirect::back();

	}

}