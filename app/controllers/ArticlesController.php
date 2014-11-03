<?php

use Blog\Articles\Article;
use Blog\Articles\Forms\NewArticleForm;
use Blog\Articles\Forms\EditArticleForm;
use Blog\Categories\Category;
use Blog\Tags\Tag;

class ArticlesController extends \BaseController {

	private $newArticleForm;
	private $editArticleForm;

	function __construct(NewArticleForm $newArticleForm, EditArticleForm $editArticleForm)
	{
		$this->newArticleForm = $newArticleForm;
		$this->editArticleForm = $editArticleForm;
	}

	public function create()
	{
		if (Input::old()){
			$article = new Article(Input::old());
			//dd($article);
		}
		else {
			$article = new Article();
		}

		return View::make('pages.articles.new')
			->withSectionTitle('New Article')
			->withArticle($article);
	}

	public function store()
	{
		$formData = Input::only('title', 'sub_title', 'body', 'public', 'category_id');
		$this->newArticleForm->validate($formData);
		$article = new Article($formData);

		$slug = $article->generateSlug($formData['title']);
		$slugCheck = Article::where('slug', '=', $slug)->first();
		if ($slugCheck){
			return Redirect::route('new_article_path')
				->withErrors("You're gonna have to change the title. It's slug is already in use.")
				->withInput();
		}
		$article->slug = $slug;

		if (isset($formData['public']) && $formData['public']){
			$article->public = 1;
		}
		$currentUser = Auth::user();
		$article->user_id = $currentUser->id;
		if ($currentUser->canWrite()){
			$article->save();
		}

		return Redirect::route('article_path', $article->slug);
	}

	public function show($slug)
	{
		$article = Article::where('slug', '=', $slug)->with('user')->first();
		$tags = $article->tags;
		if (! $article->public && ! Auth::check()){
			return Redirect::home();
		}
		$comments = $article->comments;


		return View::make('pages.articles.full')
			->withSectionTitle($article->title)
			->withArticle($article)
			->withTags($tags)
			->withComments($comments);
	}

	public function edit($slug)
	{
		$currentUser = Auth::user();
		$allTags = Tag::orderBy('label', 'asc')->get();
		$article = Article::where('slug', '=', $slug)->with('user')->with('category')->first();
		$tags = $article->tags;
		if (! $article->public && ! Auth::check() || ! $currentUser->canWrite()){
			return Redirect::home();
		}

		$categories = Category::orderBy('label', 'asc')->get();

		return View::make('pages.articles.edit')
			->withSectionTitle($article->title)
			->withCategories($categories)
			->withArticle($article)
			->withAllTags($allTags)
			->withTags($tags);
	}

	public function update($slug)
	{
		$article = Article::where('slug', '=', $slug)->with('user')->first();
		if ($article->id == 1){
			return Redirect::back()->withErrors('You can never, ever, EVER, corrupt the first article made here. Nice try.');
		}
		$formData = Input::only('title', 'sub_title', 'body', 'public', 'category_id');
		$this->editArticleForm->validate($formData);

		if ($article->title != $formData['title']){
			$titleCheck = Article::where('title', '=', $formData['title'])->first();
			if ($titleCheck){
				return Redirect::back()
					->withErrors('That title is already in use')
					->withInput();
			}
			$article->title = $formData['title'];

			$slug = $article->generateSlug($formData['title']);
			$slugCheck = Article::where('slug', '=', $slug)->first();
			if ($slugCheck){
				return Redirect::back()
					->withErrors("You're gonna have to change the title. It's slug is already in use.")
					->withInput();
			}
			$article->slug = $slug;
		}
		if ($formData['sub_title'] != $article->sub_title){
			$article->sub_title = $formData['sub_title'];
		}

		if ($formData['category_id'] != $article->category_id){
			$article->category_id = $formData['category_id'];
		}

		if ($formData['body'] != $article->body){
			$article->body = $formData['body'];
		}

		if ($formData['public'] != $article->public){
			$article->public = $formData['public'];
		}

		$currentUser = Auth::user();
		if ($currentUser->canWrite()){
			$article->save();
		}
		return Redirect::route('article_path', $article->slug);
	}

	public function publish($id)
	{
		$article = Article::find($id);
		$currentUser = Auth::user();
		if ($currentUser->canWrite()){
			$article->published = 1;
			$article->save();
		}

		return Redirect::route('article_path', $article->slug);
	}

	public function unpublish($id)
	{
		$article = Article::find($id);
		$currentUser = Auth::user();
		if ($currentUser->canWrite()){
			$article->published = 0;
			$article->save();
		}

		return Redirect::route('article_path', $article->slug);
	}

	public function drafts()
	{
		$articles = Article::where('published', '=', 0)->get();
		$currentUser = Auth::user();
		if (!$currentUser->canWrite()){
			return Redirect::home();
		}
		return View::make('pages.admin.drafts')
			->withSectionTitle('Drafts')
			->withArticles($articles);
	}

	public function destroy($id)
	{
		$currentUser = Auth::user();
		// Article ID: 1 is special to me. Never let it be deleted or I will be very sad.
		if ($id != 1 && $currentUser->canAdmin()){
			Article::destroy($id);
		}
		return Redirect::home();
	}

}