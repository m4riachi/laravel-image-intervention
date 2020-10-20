<?php

namespace M4riachi\LaravelImageIntervention;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Intervention\Image\ImageManagerStatic as Image;

class LaravelImageIntervention
{
    public function imageUrl($imagePath = '', $width = null, $height = null, $config = array())
    {
        $quality = isset($config['quality']) ? $config['quality'] : 100;
        $crop = isset($config['crop']) ? !!($config['crop']) : true;

        $cacheTtl = 60; // (app('env') !== 'local') ? 60 : 0;
        $cacheKey = "imageResize/$imagePath/$width/$height/$quality/$crop";

        $cachedUrl = Cache::get($cacheKey);

        $storage = Storage::disk('public');

        // Setup the image URLs
        // - You can add ASSET_URL=http://... to your .env to reference images through a CDN
        $hostname = Config::get('app.url', 'http://localhost');

        $urlPrefix = $hostname . '/storage/';
        $diskPath = str_replace($urlPrefix, '', $cachedUrl);

        if (null === $cachedUrl || !Storage::exists($diskPath)) {
            if (!Storage::exists($imagePath)) {
                return null;
            }

            // Return original image if height and width are 0
            if ((int)$width === null && (int)$height === null) {
                return $urlPrefix . $imagePath;
            }

            // Absolute path to full size image
            $storagePath = storage_path() . '/app/';

            // Create the new image path
            $splitAt = strrpos($imagePath, '/');
            $imageDir = substr($imagePath, 0, $splitAt);
            $imageName = substr($imagePath, $splitAt + 1);
            $resizedImagePath = "resized/" . $imageDir . "-$width" . "x$height/" . $imageName;

            // No need to continue if image already exists
            if ($storage->exists($resizedImagePath)) {
                return $urlPrefix . $resizedImagePath;
            }

            // Create the new image
            $resizedImage = Image::make($storagePath . $imagePath);

            // Crop/Resize always needs height AND width
            $width = empty($width) ? 1600 : $width;
            $height = empty($height) ? 1600 : $height;

            // Shall we crop or resize?
            if ($crop) {
                $resizedImage->fit((int)$width, (int)$height, function ($constraint) {
                    $constraint->upsize();
                });
            } else {
                $resizedImage->resize((int)$width, (int)$height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $resizedImage->encode('', (int)$quality);

            // And put it where it needs to go
            $storage->put($resizedImagePath, (string)$resizedImage, 'public');

            $cachedUrl = $urlPrefix . $resizedImagePath;
        }

        return $cachedUrl;
    }
}
