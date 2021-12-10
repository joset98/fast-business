<?php

namespace App\Http\Controllers;

use App\Events\DiscountProductFromStock;
use App\Http\Requests\Purchases\StoreRequest;
use App\Http\Services\ProductService;
use App\Http\Services\PurchaseService;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    private $purchaseService;

    public function __construct(PurchaseService $service)
    {
        $this->purchaseService = $service;
    }

    public function index()
    {
        $userPurchases = $this->purchaseService->usersInvoicing();
        return view('admin.purchases.index', compact('userPurchases'));
    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $product = Product::find($request->product_id);

        abort_if(!!($product->stock - $request->quantity <= 0), 
            500, 
            'Cantidad no disponible o producto fuera de stock');

        $total = ($product->cost + ($product->cost * ( $product->tax / 100) )) * $request->quantity;

        $newPurchase = Purchase::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'total' => $total,
        ]);

        DiscountProductFromStock::dispatch($newPurchase);
      
        return response()->json([
            'data' => 'Compra registrada correctamente'
        ],200);
    }
}
