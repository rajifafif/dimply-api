<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'lat',
        'lng',
    ];
    
    public $hidden = ['created_at', 'updated_at'];

    public function promos()
    {
        return $this->hasMany(Promo::class, 'tenant_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tenant_categories', 'tenant_id', 'category_id')
            ->withPivot(['priority']);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
