<?php

namespace App\CPU;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageSizeManager
{
    public static function upload(string $image_name, string $dir, string $format, $image = null)
    {
        if ($image_name == 'thumbnail_image') {

            if ($image != null) {

                $upload_file = $image;
                $height = Image::make($image)->height();
                $width = Image::make($image)->width();
                $size = min($width, $height);


                if ($height < 243 && $width < 243) {

                    $image_resize = Image::make($image)->resizeCanvas(243, 243, 'center', false, 'ffffff')->encode('png', 90);
                } elseif ($height > $width) {
                    // $width = round($width / ($height/243));
                    $image_resize = Image::make($image)->resize(null, 243, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image_resize = $image_resize->resizeCanvas(243, 243, 'center', false, 'ffffff')
                        ->encode('png', 90);

                    //->resizeCanvas($width, $size, 'center', false, 'ffffff')->encode('png',90);
                } else {
                    //$height = round($height / ($width/243));
                    $image_resize = Image::make($image)->resize(243, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image_resize = $image_resize->resizeCanvas(243, 243, 'center', false, 'ffffff')
                        ->encode('png', 90);
                }


                $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }
                Storage::disk('public')->put($dir . $imageName, $image_resize);
            } else {
                $imageName = 'def.png';
            }
            return $imageName;
        }
        else{

            if ($image != null) {
                $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }
                Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            } else {
                $imageName = 'def.png';

            }
            return $imageName;
        }
    }

    public static function uploadAndCrop(string $crop_size, string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $height = Image::make($image)->height();
            $width = Image::make($image)->width();
            $size = min($width, $height);


            if ($height < $crop_size && $width < $crop_size) {

                $image_resize = Image::make($image)->resizeCanvas($crop_size, $crop_size, 'center', false, 'ffffff')->encode('png', 90);
            } elseif ($height > $width) {
                // $width = round($width / ($height/243));
                $image_resize = Image::make($image)->resize(null, $crop_size, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize = $image_resize->resizeCanvas($crop_size, $crop_size, 'center', false, 'ffffff')
                    ->encode('png', 90);

                //->resizeCanvas($width, $size, 'center', false, 'ffffff')->encode('png',90);
            } else {
                //$height = round($height / ($width/243));
                $image_resize = Image::make($image)->resize($crop_size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize = $image_resize->resizeCanvas($crop_size, $crop_size, 'center', false, 'ffffff')
                    ->encode('png', 90);
            }


            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, $image_resize);
        } else {
            $imageName = 'def.png';
        }
        return $imageName;
    }

    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        /*if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageManager::upload($dir, $format, $image);
        return $imageName;*/

        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageSizeManager::upload('', $dir, $format, $image);
        return $imageName;
    }

    public static function updateThumb(string $dir, $old_image, string $format, $image = null)
    {
        /*if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageManager::upload($dir, $format, $image);
        return $imageName;*/

        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageManager::upload('thumbnail_image', $dir, $format, $image);
        return $imageName;
    }

    public static function delete($full_path)
    {
        if (Storage::disk('public')->exists($full_path)) {
            Storage::disk('public')->delete($full_path);
        }

        return [
            'success' => 1,
            'message' => 'Removed successfully !'
        ];

    }
}