@extends('layouts.app')

@section('title', 'Listado de Facturas')

@section('content')
<div class="container flex-center pt-2">

    <div class="table-content">

        <div class="list-header space-between">

            <div class="table-title">
                <h2>Facturas Emitidas</h2>
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

                <th>
                    Fecha de Facturacion
                </th>

                <th>
                    Acciones
                </th>

            </thead>

            <tbody class="">

                @forelse ($invoices as $invoice)
                <tr>
                    <td>
                        {{$invoice->user->name}}
                    </td>
                    <td>
                        {{$invoice->total}}
                    </td>
                    <td>
                        {{$invoice->total_tax}}
                    </td>
                    <td>
                        {{$invoice->invoice_date}}
                    </td>
                    
                    <td id="actions-row">

                        <a href="{{route('invoices.show', $invoice->id )}}" 
                            class="action-table action-bill"
                        >
                            Desglosar
                        </a>

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