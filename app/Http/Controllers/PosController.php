<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        $customers = Customer::all();
        
        return view('pos.index', compact('categories', 'products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'cart' => 'required|array|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            $invoiceNumber = 'ART-' . strtoupper(Str::random(8));
            
            $transaction = Transaction::create([
                'invoice_number' => $invoiceNumber,
                'customer_id' => $request->customer_id,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
            ]);

            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);
                
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                // Update stock
                $product->decrement('stock', $item['quantity']);
            }

            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id,
                'redirect_url' => route('pos.invoice', $transaction->id)
            ]);
        });
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load(['customer', 'details.product']);
        return view('pos.invoice', compact('transaction'));
    }
}
