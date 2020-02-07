<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
	private $store;

	public function __construct(Store $store)
	{
		$this->store = $store;
	}

	public function index($slug)
    {
		$store = $this->store->whereSlug($slug)->first();
		return view('store', compact('store'));
    }
}
