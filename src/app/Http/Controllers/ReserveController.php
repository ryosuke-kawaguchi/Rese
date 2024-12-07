<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\ReserveUpdateRequest;

class ReserveController extends Controller
{
    public function store(ReserveRequest $request)
    {
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

    public function show()
    {
        $reserve = session('reserve');

        return view('done', compact('reserve'));
    }

    public function update(ReserveUpdateRequest $request, $id)
    {
        $reserve = Reserve::findOrFail($id);
        $reserve->update($request->validated());

        return redirect()->back()->with('success__update', '予約情報を更新しました。');
    }
}
