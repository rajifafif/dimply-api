<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $fillabe = [
        'type',
        'name',
        'original_name',
        'extension',
        'path'
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'fileable_type',
        'fileable_id',
        'id',
        // 'type'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getFileUrlAttribute()
    {
        if (str_contains($this->path, 'http')) {
            return $this->path;
        } else {
            $pathWithoutPublic = str_replace('public/', '', $this->path,);
            return asset($pathWithoutPublic);
        }
    }
}
