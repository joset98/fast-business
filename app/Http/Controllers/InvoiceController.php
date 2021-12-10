<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Invoices\StoreRequest;
use App\Http\Services\PurchaseService;
use App\Models\Invoice;
use App\Models\User;

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
        $invoices->each(function ($item){
            if($item->created_at)
                return $item->invoice_date = $item->created_at->format('d-m-y');
                $item->invoice_date = 'No fecha disponible';
        });
        return view('admin.invoices.index', compact('invoices'));
    }

    public function generateInvoices(Request $request)
    {
        // abort_if(!$request->ajax(), 500, 'Error al tratar de hacer la operacion');

        $usersWithoutInvoices = $this->purchaseService->usersInvoicing();

        $usersWithoutInvoices->map( function ($userItem) {
                        
            $newInvoice = Invoice::create([
                'user_id' => $userItem->id,
                'total' => $userItem->purchases_sum_total,
                'total_tax' => $userItem->tax_sum_total,
            ]);

            $userItem->purchases->map(function ($purchaseItem) use ($newInvoice){
                $purchaseItem->invoice()->associate($newInvoice);
                $purchaseItem->save();
            });

            }
        );
                
        return response()->json([
            'data' => ['message' => 'Facturas Generadas']
        ],200);;
    }

    // Calcula el total por todas la compras y el impuesto total cobrado
    public function productSum()
    {
        $userPurchases = User::has('purchases')->with('purchases.product')
            ->withSum('purchases','total')->get();

        $userPurchases->map( function($userItem){
            $userItem->tax_sum_total = $userItem->purchases->reduce( 
                function ($carry, $purchaseItem) {
                    return $carry + round(
                    ($purchaseItem->quantity * $purchaseItem->product->cost *
                         $purchaseItem->product->tax / 100), 2);
                }, 0);
        });


    }

    public function show($userId){
        $invoice = Invoice::where('id', $userId)
                ->with(['purchases' => function ($query){
                    $query->orderBy('created_at','asc');
                },'purchases.product'])
                ->first();

        $productsFromInvoice = $invoice->purchases->map->product; 
        return view('admin.invoices.show', compact('invoice','productsFromInvoice'));
    }

    public function invoicingPurchases(){

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
