<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ImageHelper
{
    public static function compressImg($copyfile, $maxWidth, $maxHeight, $quality, $start_size)
    {
        $iphone = false;

        $handle = fopen($copyfile, 'rb');
        $bytes = fread($handle, 100);
        fclose($handle);
        $hasExif = (strpos($bytes, 'Exif') !== false);

        if ($hasExif) {
            $exif = @exif_read_data($copyfile, 0, true);
            if ($exif && isset($exif['IFD0']['Make'], $exif['IFD0']['Model'], $exif['IFD0']['Orientation'])) {
                $brand = $exif["IFD0"]["Make"];
                $camera = $exif["IFD0"]["Model"];
                if (strtolower($brand) == 'apple' && strpos(strtolower($camera), 'iphone') !== false && $exif['IFD0']['Orientation'] == 6) {
                    $iphone = true;
                }
            }
        }

        list($width, $height) = getimagesize($copyfile);
        $origWidth = $width;
        $origHeight = $height;

        if (filesize($copyfile) > $start_size) {
            $i = 0;
            $percent = 1;
            do {
                list($width, $height) = getimagesize($copyfile);
                $new_width = $width * $percent;
                $new_height = $height * $percent;
                $image_p = imagecreatetruecolor($new_width, $new_height);

                if ($percent > 0.019) {
                    $percent -= 0.019;
                }

                if ($i > 100 || filesize($copyfile) < $start_size) {
                    break;
                }

                $i++;
            } while ($new_width > $maxWidth || $new_height > $maxHeight);

            list($width, $height) = getimagesize($copyfile);
            $image_p = imagecreatetruecolor($new_width, $new_height);

            $imageType = exif_imagetype($copyfile);
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($copyfile);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($image_p, $copyfile, $quality);

                    // iPhone rotation fix
                    if ($origWidth == 4032 && $origHeight == 3024 && $iphone) {
                        $source = imagecreatefromjpeg($copyfile);
                        $rotate = imagerotate($source, 270, 0);
                        imagejpeg($rotate, $copyfile);
                    }
                    if ($origWidth == 5712 && $origHeight == 4284 && $iphone) {
                        $source = imagecreatefromjpeg($copyfile);
                        $rotate = imagerotate($source, 270, 0);
                        imagejpeg($rotate, $copyfile);
                    }
                    if ($origWidth == 8064 && $origHeight == 6048 && $iphone) {
                        $source = imagecreatefromjpeg($copyfile);
                        $rotate = imagerotate($source, 270, 0);
                        imagejpeg($rotate, $copyfile);
                    }
                    return true;

                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($copyfile);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagepng($image_p, $copyfile, 9);
                    return true;

                case IMAGETYPE_WEBP:
                    $image = imagecreatefromwebp($copyfile);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagewebp($image_p, $copyfile, $quality);
                    return true;

                case IMAGETYPE_AVIF:
                    if (function_exists('imagecreatefromavif')) {
                        $image = imagecreatefromavif($copyfile);
                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        imageavif($image_p, $copyfile, $quality);
                        return true;
                    }
                    break;
            }
        }

        return false;
    }
}
