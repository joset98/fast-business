<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchases\StoreRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

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
        

        return response()->json([
            'data' => 'Producto registrado correctamente'
        ],200);
    }
}
