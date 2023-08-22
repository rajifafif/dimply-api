<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromoCollection;
use App\Http\Resources\PromoResource;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'categories' => 'required'
        ]);

        $promos = Promo::query()
            ->whereHas('tenant.categories', function ($categories) use ($request) {
                $categories->whereIn('slug', $request['categories']);
            })
            ->when($request->search != '', function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })
            ->when($request->sort_by != '', function($query) use ($request) {
                $query->orderBy('percentage', 'asc');
            })
            ->with(['tenant', 'files', 'tenant.files'])
            ->paginate(5);

        return PromoResource::collection($promos)->response()->getData(true);
    }
}
