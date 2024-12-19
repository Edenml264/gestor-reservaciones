<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function updateImage(UploadedFile $image, string $path = null)
    {
        $this->deleteImage();

        $path = $path ?? $this->getImagePath();
        $filename = $image->store($path, 'public');
        
        $this->attributes['image_url'] = $filename;
        $this->save();

        return $this;
    }

    public function deleteImage()
    {
        if (!empty($this->attributes['image_url'])) {
            Storage::disk('public')->delete($this->attributes['image_url']);
        }
    }

    protected function getImagePath(): string
    {
        return strtolower(class_basename($this)) . 's';
    }

    public function getImageUrlAttribute($value)
    {
        if (empty($this->attributes['image_url'])) {
            return null;
        }

        return Storage::disk('public')->url($this->attributes['image_url']);
    }
}
