<?php

use Blog\Articles\Article;
use Blog\Categories\Category;
use Blog\Categories\Forms\AddCategoryForm;

class CategoriesController extends \BaseController {

	/**
	 * @var AddCategoryForm
	 */
	private $addCategoryForm;

	public function __construct(AddCategoryForm $addCategoryForm)
	{

		$this->addCategoryForm = $addCategoryForm;
	}

	public function index()
	{
		$categories = Category::orderBy('label', 'asc')->get();

		return View::make('pages.admin.categories')
			->withSectionTitle('Categories')
			->withCategories($categories);
	}

	public function add()
	{
		$currentUser = Auth::user();
		$formData = Input::only('label');
		$this->addCategoryForm->validate($formData);
		$category = new Category($formData);

		if ($currentUser->canWrite()){
			$category->save();
		}

		return Redirect::back();

	}

	public function update($id)
	{
		$currentUser = Auth::user();
		$category = Category::find($id);
		$formData = Input::only('label');
		if ($category->label != $formData['label']){
			$this->addCategoryForm->validate($formData);
			$category->label = $formData['label'];
			if ($currentUser->canWrite()){
				$category->save();
			}
		}

		return Redirect::back();

	}

	public function filter($label)
	{
		$currentUser = Auth::user();
		$category = Category::where('label', '=', $label)->first();
		if (!$category){
			return Redirect::home();
		}
		if ($currentUser){
			$articles = Article::where('category_id', '=', $category->id)->orderBy('updated_at', 'desc')->with('category')->get();
		}
		else {
			$articles = Article::where('category_id', '=', $category->id)->where('public', '=',1)->orderBy('updated_at', 'desc')->with('category')->get();
		}

		return View::make('pages.articles.filtered')
			->withSectionTitle($category->label)
			->withHeading($category->label)
			->withArticles($articles);
	}

	public function destroy($id)
	{
		$currentUser = Auth::user();
		if ($currentUser->canWrite()){
			Category::destroy($id);
			$articles = Article::where('category_id', '=', $id)->get();
			foreach ($articles as $article){
				$article->category_id = 0;
				$article->save();
			}
		}

		return Redirect::back();

	}

}