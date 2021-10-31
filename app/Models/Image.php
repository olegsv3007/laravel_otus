<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function getImageSrcAttribute()
    {
        return asset(
            Storage::disk('images')
                ->url($this->imaginable_type::FOLDER_PHOTOS . '/' . $this->filename)
        );
    }
}
