<?php

use Blog\Articles\Article;
use Blog\Articles\Forms\NewArticleForm;

class ArticlesController extends \BaseController {


	/**
	 * @var NewArticleForm
	 */
	private $newArticleForm;

	function __construct(NewArticleForm $newArticleForm)
	{
		$this->newArticleForm = $newArticleForm;
	}

	public function index()
	{
		//
	}

	public function create()
	{
		return View::make('pages.articles.new')
			->withSectionTitle('New Article');
	}

	public function store()
	{
		$formData = Input::all();
		$this->newArticleForm->validate($formData);
		$article = new Article($formData);
		$slug = $article->generateSlug($formData['title']);
		$slugCheck = Article::where('slug', '=', $slug)->first();
		if ($slugCheck){
			return Redirect::route('new_article_path')->withErrors("You're gonna have to change the title. It's slug is already in use.")->withInput();
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

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}