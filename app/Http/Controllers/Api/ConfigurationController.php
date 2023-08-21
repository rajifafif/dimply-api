<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        $paymentMethods = PaymentMethod::get();

        return response()->json([
            'categories' => $categories,
            'payment_methods' => $paymentMethods
        ]);
    }
}
