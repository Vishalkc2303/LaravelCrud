<?php
// app/Helpers/ImageHelper.php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function uploadImage($image, $path, $resizeWidth = null, $resizeHeight = null)
    {
        // Generate a unique name for the image
        $imageName = time().'.webp';

        // Create an instance of Intervention Image
        $img = Image::make($image->getRealPath());

        // Resize the image if dimensions are provided
        if ($resizeWidth && $resizeHeight) {
            $img->resize($resizeWidth, $resizeHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        // Encode the image to webp format
        $img->encode('webp');

        // Store the image in the specified path
        Storage::disk('public')->put($path.'/'.$imageName, $img);

        return $imageName;
    }
}
