@extends('layouts.app')

@section('title', 'Listado de Facturas')

@section('content')

<div class="container flex-center pt-2">
@include('messages.flash_message')

    <div class="table-content">

        <div class="list-header space-between">

            <div class="table-title">
                <h1>Facturas Emitidas</h1>
            </div>

            <div class="pending-invoices">
                <p>Facturas pendientes:</p>
                @if($pendingPurchases)
                    <p><strong>{{$pendingPurchases}}</strong> clientes pendientes sin facturar</p>
                @else
                    <p>No hay clientes pendientes</p>
                @endif

            </div>

            <div class="table-button">
                <form id="invoice-form" action="{{ route('invoices.generate') }}" method="post">
                   @csrf
                    <button type="submit" class="action-table action-bill">
                        Emitir Facturas
                    </button>

                </form>
            </div>

        </div>

        <table class="products-table" id="invoices-table">

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

        </table>

    </div>

</div>

@endsection