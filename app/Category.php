<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Category extends Model
{
	use Slug;

	protected $fillable = ['name', 'description', 'slug'];


	public function products()
    {
    	return $this->belongsToMany(Product::class);
    }
}
