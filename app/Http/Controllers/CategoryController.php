<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

    public function index($slug)
    {
		$category = $this->category->whereSlug($slug)->first();

		return view('category', compact('category'));
    }
}
