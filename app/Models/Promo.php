<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 
        'tenant_id',
        'description',
        'start_at',
        'end_at',
        'original_price',
        'discounted_price',
        'type',
        'min_amount',
        'max_amount',
        'percentage',
        'min_purchase_amount',
        'quota',
        'tnc'
    ];

    public $hidden = ['created_at', 'updated_at'];

    public $casts = [
        'percentage' => 'double'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'promo_payment_methods', 'promo_id', 'payment_method_id');
    }
}
