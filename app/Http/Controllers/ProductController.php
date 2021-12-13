<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use App\Models\Product;
use App\Http\Requests\Products\StoreRequest;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.products.index');
    }

    public function productList()
    {
        $products = Product::simplePaginate(12);
        
        return view('products.index', compact('products'));
    }

    public function productsTable()
    {

        $products = Product::all();

        return response()->json([
            'data' => $products
        ],200);
    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $newProduct = Product::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'tax' => $request->tax,
            'stock' => $request->stock,
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
        try {
            $updatedProduct = Product::where('id', $request->id)
                            ->update([
                                'name' => $request->name,
                                'cost' => $request->cost,
                                'tax' => $request->tax,
                                'stock' => $request->stock
                            ]);
            if (!$updatedProduct)
                return redirect()->route('products')->withErrors([
                    'errors' => 'Hubo un error, al querer editar el producto.'
                ]);

            return redirect()->route('products.index')->with('statusUpdate','Producto actualizado!');
        } catch (\Throwable $th) {
            return redirect()->route('products')->withErrors([
                'errors' => 'Hubo un error, al querer editar el producto.'
            ]);
        }
    }

    public function destroy($id)
    {
        try {

            $deleteProduct = Product::find($id)->delete();
            return response()->json([
                'data' => 'Producto eliminado correctamente'
            ],200);

        } catch (\Throwable $th) {
            dd($th);
            abort( 500, 'Error en la accion');
        }

    }

    public function edit($id)
    {
        try {
            
            $product = Product::find($id);
            return view('admin.products.edit', compact('product'));

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => 'Hubo un error, al querer editar el objeto.']);
        }

    }

}
