@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="container flex-center">

    @include('forms.products.create')
    @include('messages.flash_message')

    <div class="table-content">

        <div class="list-header">

            <div class="table-title">
                <h2>Lista de Productos</h2>
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

                @forelse ($products as $product)
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

                    <td id="actions-row">
                        <form id="actions-form" action="{{ url('/products',[$product->id]) }}" method="POST">
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
                <tr>
                    <td colspan="3">
                        No hay Productos Disponibles
                    </td>
                </tr>
                @endforelse


            </tbody>

        </table>

    </div>

</div>



@endsection