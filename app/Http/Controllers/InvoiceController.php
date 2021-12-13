<?php

namespace App\Http\Controllers;

use App\Events\UpdateInvoicedPurchases;
use Illuminate\Http\Request;

use App\Http\Requests\Invoices\StoreRequest;
use App\Http\Services\PurchaseService;
use App\Models\Invoice;

class InvoiceController extends Controller
{

    private $purchaseService;

    public function __construct(PurchaseService $service)
    {
        $this->purchaseService = $service;
    }

    public function index()
    {
        $invoices = Invoice::with('user')->get();
        $pendingPurchases = $this->purchaseService->purchasesWithoutInvoicing()->count();
        $invoices->each(function ($item){
            if($item->created_at)
                return $item->invoice_date = $item->created_at->format('d-m-y');
                $item->invoice_date = 'No fecha disponible';
        });
        return view('admin.invoices.index', compact('pendingPurchases'));
    }

    public function invoiceTable()
    {
        $invoices = Invoice::with('user')->get();
        $invoices->each(function ($item){
            if($item->created_at)
                return $item->invoice_date = $item->created_at->format('d-m-y');
                $item->invoice_date = 'No fecha disponible';
        });
        
        return response()->json([
            'data' => $invoices
        ],200);
    }

    public function generateInvoices(Request $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $usersWithoutInvoices = $this->purchaseService->usersInvoicing();
        abort_if($usersWithoutInvoices->isEmpty(), 500, 'No hay facturas pendientes');

        $isInvoiced = $this->purchaseService->generatePendingInvoices($usersWithoutInvoices);
        abort_if(!$isInvoiced, 500, 'Error al tratar de hacer la operacion');

        $collectionPurchaseId = $usersWithoutInvoices->map->purchases->flatten(1)->map->id;
        UpdateInvoicedPurchases::dispatch($collectionPurchaseId);
               
        return response()->json([
            'data' => ['message' => 'Facturas Generadas']
        ],200);
    }

    public function show($userId){
        $invoice = Invoice::where('id', $userId)
                ->with(['purchases' => function ($query){
                    $query->orderBy('created_at','asc');
                },'purchases.product'])
                ->first();

        $productsFromInvoice =$invoice->purchases->map(function($item){
            $item->product->quantity = $item->quantity;
            return $item->product;
        });

        return view('admin.invoices.show', compact('invoice','productsFromInvoice'));
    }

    public function invoicingPurchases(){

    }

    public function store(StoreRequest $request)
    {
        abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');
        
        return response()->json([
            'data' => 'Factura registrado correctamente'
        ],200);
    }
}
