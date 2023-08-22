<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $merchants = Tenant::limit(5)->paginate(5);

        return response()->json($merchants);
    }
}
