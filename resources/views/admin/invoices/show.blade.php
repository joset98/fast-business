@extends('layouts.app')

@section('title', 'Desglose de Factura')

@section('content')
<div class="container flex-center pt-2">

    <div class="table-content">

        <div class="list-header space-between">

            <div class="table-title">
                <h1>Lista de Productos Facturados</h1>
            </div>

            <div class="invoice-user">
                <h2>Usuario: {{$invoice->user->name}}</h2>
            </div>

            <div class="table-resume">
                <h3>Monto Total: {{$invoice->total}}</h3>
                <h3>Impuesto Total: {{$invoice->total_tax}}</h3>
            </div>

        </div>

        <table class="products-table">

            <thead>
                <th>
                    Producto
                </th>

                <th>
                    Precio del producto
                </th>

                <th>
                    Impuesto
                </th>
                
                <th>
                    Cantidad comprada
                </th>
            </thead>

            <tbody class="products-btable">

                @forelse ($productsFromInvoice as $product)
                <tr>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->cost}}
                    </td>
                    <td>
                        {{$product->tax}} %
                    </td>
                    <td>
                        {{$product->quantity}} und
                    </td>

                </tr>
                @empty
                <tr class="empty-table">
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