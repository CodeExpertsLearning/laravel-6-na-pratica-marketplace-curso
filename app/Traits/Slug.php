<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Slug
{
	public function setNameAttribute($value)
	{
		$slug = Str::slug($value);
		$matchs = $this->uniqueSlug($slug);

		$this->attributes['name'] = $value;
		$this->attributes['slug'] =  $matchs ? $slug . '-' . $matchs : $slug;
	}

	public function uniqueSlug($slug)
	{
		$matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();

		return $matchs;
	}
}