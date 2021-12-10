<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PurchaseService
{
    public function purchasesWithoutInvoicing()
    {
        $userPurchases = User::whereHas('purchases', 
            function(Builder $query){
                $query->where('invoice_id', null);
            })
            ->with(['purchases'=> function ($query){
                $query->where('purchases.invoice_id', null);            
            },'purchases.product']);

        return $userPurchases;
    }


    public function totalTaxWithoutInvoicing()
    {
        $usersWithoutInvoicing = $this->purchasesWithoutInvoicing()
            ->withSum(['purchases' => function ($query){
                $query->where('purchases.invoice_id', null);            
            }],'total')->get();
         
        return $usersWithoutInvoicing->map( 
            function($userItem){
                $userItem->tax_sum_total = $userItem->purchases->reduce( 
                    function ($carry, $purchaseItem) {
                        return $carry + round(
                        ($purchaseItem->quantity * $purchaseItem->product->cost *
                            $purchaseItem->product->tax / 100), 2);
                    }, 0);
                return $userItem;
            }   
        );
    }

    public function usersInvoicing()
    {
        $usersWithoutInvoicingWithTotalTax = $this->totalTaxWithoutInvoicing(); 
        return $usersWithoutInvoicingWithTotalTax;
    }
}

