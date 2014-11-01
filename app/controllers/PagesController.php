<?php

use Blog\Articles\Article;

class PagesController extends BaseController {

	public function home(){

		if (Auth::check()){
			$articles = Article::where('published', '=', 1)->orderBy('created_at', 'desc')->take(10)->get();
		}
		else {
			$articles = Article::where('public', '=', '1')->where('published','=',1)->orderBy('created_at', 'desc')->take(10)->get();
		}
		$articles->load('user');

		return View::make('pages.generic.home')
			->withSectionTitle('Home')
			->withArticles($articles);
	}
} 