<?php

use Blog\Articles\Article;
use Blog\Articles\Forms\NewArticleForm;
use Blog\Articles\Forms\EditArticleForm;

class ArticlesController extends \BaseController {


	/**
	 * @var NewArticleForm
	 */
	private $newArticleForm;
	/**
	 * @var EditArticleForm
	 */
	private $editArticleForm;

	function __construct(NewArticleForm $newArticleForm, EditArticleForm $editArticleForm)
	{
		$this->newArticleForm = $newArticleForm;
		$this->editArticleForm = $editArticleForm;
	}

	public function index()
	{
		//
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
		$formData = Input::only('title', 'sub_title', 'body', 'public');
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
		$article->save();

		return Redirect::route('article_path', $article->slug);
	}

	public function show($slug)
	{
		$article = Article::where('slug', '=', $slug)->with('user')->first();
		if (! $article->public && ! Auth::check()){
			return Redirect::home();
		}

		return View::make('pages.articles.full')
			->withSectionTitle($article->title)
			->withArticle($article);
	}

	public function edit($slug)
	{
		$currentUser = Auth::user();
		$article = Article::where('slug', '=', $slug)->with('user')->first();
		if (! $article->public && ! Auth::check() || ! $currentUser->canWrite()){
			return Redirect::home();
		}

		return View::make('pages.articles.edit')
			->withSectionTitle($article->title)
			->withArticle($article);
	}

	public function update($slug)
	{
		$article = Article::where('slug', '=', $slug)->with('user')->first();
		if ($article->id == 1){
			return Redirect::back()->withErrors('You can never, ever, EVER, corrupt the first article made here. Nice try.');
		}
		$formData = Input::only('title', 'sub_title', 'body', 'public');
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
		if ($formData['body'] != $article->body){
			$article->body = $formData['body'];
		}

		if ($formData['public'] != $article->public){
			$article->public = $formData['public'];
		}

		$article->save();
		return Redirect::route('article_path', $article->slug);
	}

	public function destroy($id)
	{
		if ($id != 1){
			Article::destroy($id);
		}

		return Redirect::home();
	}

}