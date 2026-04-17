<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shop = Shop::first();
        return view('shop.index', compact('shop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|url',
            'address' => 'nullable',
            'phone' => 'nullable'
        ]);

        $shop = Shop::first();
        $shop->update($request->all());

        return redirect()->route('shop.index')->with('success', 'Shop identity updated successfully.');
    }
}
