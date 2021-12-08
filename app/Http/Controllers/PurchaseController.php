<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchases\StoreRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $products = Purchase::all();
        return view('admin.products.index', compact('products'));
    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $product = Product::find($request->product_id);
        $newPurchase = Purchase::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'total' => $product->cost + ($product->cost * ( $product->tax / 100) ),
        ]);
      
        return response()->json([
            'data' => 'Compra registrada correctamente'
        ],200);
    }
}
