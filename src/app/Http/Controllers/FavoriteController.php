<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;

class FavoriteController extends Controller
{
    public function toggle($shopId)
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shopId,
            ]);
        }

        return redirect()->back();
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->pluck('shop_id')->toArray();
        $reserves = Reserve::where('user_id', Auth::id())->get();
        return view('mypage', compact('favorites', 'reserves'));
    }
}

