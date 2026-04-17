<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('inventory.index', compact('products'));
    }

    public function hub()
    {
        $counts = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'customers' => Customer::count(),
        ];
        return view('master.hub', compact('counts'));
    }
}
