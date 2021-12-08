@extends('layouts.app')

@section('title', 'Listado de Facturas')

@section('content')
<div class="container flex-center pt-2">

    <div class="table-content">

        <div class="list-header">

            <div class="table-title">
                <h2>Lista de Facturas</h2>
            </div>

        </div>

        <table class="products-table">

            <thead>
                <th>
                    Nombre
                </th>

                <th>
                    Costo
                </th>

                <th>
                    Impuesto
                </th>

                <th>
                    Acciones
                </th>

            </thead>

            <tbody class="products-btable">

                @forelse ($invoices as $invoice)
                <tr>
                    <td>
                        {{$invoice->name}}
                    </td>
                    <td>
                        {{$invoice->cost}}
                    </td>
                    <td>
                        {{$invoice->tax}} %
                    </td>

                    <td id="actions-row">
                        <form id="actions-form" action="{{ url('/products',[$invoice->id]) }}" method="POST">
                            @csrf

                            <button type="submit" class="action-table action-update">
                                Actualizar
                            </button>

                            <button type="submit" class="action-table action-delete" >
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <>
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