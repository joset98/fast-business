<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Invoices\StoreRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $products = Invoice::all();
        return view('admin.products.index', compact('products'));
    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');
        

        // abort_if(!$newProduct, 500, 'Error al registrar el producto');

        return response()->json([
            'data' => 'Factura registrado correctamente'
        ],200);
    }
}
