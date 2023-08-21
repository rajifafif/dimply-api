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

    public function fileable()
    {
        return $this->morphTo();
    }
}
