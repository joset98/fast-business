<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Products\StoreRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function productList()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $newProduct = Product::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'tax' => $request->tax,
        ]);

        abort_if(!$newProduct, 500, 'Error al registrar el producto');

        return response()->json([
            'data' => [
                'message'=> 'Producto registrado correctamente',
                'new_product' => $newProduct
            ]
        ],200);
    }

    public function update(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');
        
        $newProduct = Product::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'tax' => $request->description,
        ]);

        abort_if(!$newProduct, 500, 'Error al registrar el producto');

        return response()->json([
            'data' => 'Producto registrado correctamente'
        ],200);
    }

    public function destroy($id)
    {
        try {
            $deleteProduct = Product::find($id)->delete();
            return response()->json([
                'data' => 'Producto eliminado correctamente'
            ],200);
        } catch (\Throwable $th) {
            abort( 500, 'Error en la accion');
        }

    }

}
