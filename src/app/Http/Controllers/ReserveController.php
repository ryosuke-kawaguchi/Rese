<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function storeReservation(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'member' => 'required|integer|min:1',
            'shop_name' => 'required|string',
        ]);
        $reserve = Reserve::create([
            'user_id' => Auth::id(),
            'shop_name' => $request->input('shop_name'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'member' => $request->input('member'),
        ]);
        return redirect()->route('done')->with('reserve', $reserve);
    }

    public function destroy($id)
    {
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();
        return redirect()->back()->with('success__delete', '予約を削除しました。');
    }

    public function showDone()
    {
        $reserve = session('reserve');
        return view('done', compact('reserve'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'member' => 'required|integer|min:1',
        ]);
        $reserve = Reserve::findOrFail($id);
        $reserve->update([
            'shop_name' => $request->input('shop_name'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'member' => $request->input('member'),
        ]);
        return redirect()->back()->with('success__update', '予約情報を更新しました。');
    }
}
