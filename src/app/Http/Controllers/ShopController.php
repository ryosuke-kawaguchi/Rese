<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = config('shop-data.shop');
        $genres = collect($shops)->pluck('genre')->unique();
        $areas = collect($shops)->pluck('area')->unique();

        return view('shop',compact('shops', 'genres', 'areas'));
    }

    public function search(Request $request)
    {
        $shops = collect(config('shop-data.shop'));

        if ($request->filled('area')) {
            $shops = $shops->where('area', $request->input('area'));
        }

        if ($request->filled('genre')) {
            $shops = $shops->where('genre', $request->input('genre'));
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $shops = $shops->filter(function ($shop) use ($keyword) {
                return str_contains($shop['name'], $keyword) || str_contains($shop['text'], $keyword);
            });
        }

        $genres = $shops->pluck('genre')->unique();
        $areas = $shops->pluck('area')->unique();

        return view('shop', compact('shops', 'genres', 'areas'));
    }

    public function detail($id)
    {
        $shops = config('shop-data.shop');
        $shop = collect($shops)->firstWhere('id',$id);
        $shop['img'] = asset($shop['img']);

        return view('detail',['shop'=> $shop]);
    }
}
