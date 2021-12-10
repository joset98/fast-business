@extends('layouts.app')

@section('title', 'Listado de Compras')

@section('content')
<div class="container flex-center pt-2">

    <div class="table-content">

        <div class="list-header space-between">

            <div class="table-title">
                <h2>Lista de Compras</h2>
            </div>

            <div class="table-button">
                <form action="{{ route('invoices.generate') }}" method="get">
                   
                    <button type="submit" class="action-table action-bill">
                        Emitir Facturas
                    </button>

                </form>
            </div>


        </div>

        <table class="products-table">

            <thead>
                <th>
                    Usuario
                </th>

                <th>
                    Total
                </th>

                <th>
                    Impuesto Total Cobrado
                </th>


            </thead>

            <tbody class="products-btable">

                @forelse ($userPurchases as $userPurchase)
                <tr>
                    <td>
                        {{$userPurchase->name}}
                    </td>
                    <td>
                        {{$userPurchase->purchases_sum_total}}
                    </td>
                    <td>
                        {{$userPurchase->tax_sum_total}}
                    </td>

                </tr>
                @empty
                    <td colspan="3">
                        No hay Facturas Disponibles
                    </td>
                </tr>
                @endforelse


            </tbody>

        </table>

    </div>

</div>



@endsection