<?php
namespace App\Traits;

trait UploadTrait
{
	private function imageUpload($images, $imageColumn = null)
	{

		$uploadedImages = [];

		if(is_array($images)) {

			foreach($images as $image) {
					$uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
			}

		} else {
			$uploadedImages = $images->store('logo', 'public');
		}

		return $uploadedImages;
	}
}