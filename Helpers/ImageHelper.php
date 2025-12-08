<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getImagePath($path, $default = 'no-image.jpg')
    {
        if (empty($path)) {
            return asset('img/' . $default);
        }

        // Cek apakah file ada
        $publicPath = public_path($path);

        if (file_exists($publicPath)) {
            return asset($path);
        }

        // Coba cari di folder img
        $fileName = basename($path);
        $imgPath = 'img/' . $fileName;

        if (file_exists(public_path($imgPath))) {
            return asset($imgPath);
        }

        return asset('img/' . $default);
    }
}
