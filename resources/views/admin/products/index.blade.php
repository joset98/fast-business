@extends('layouts.app')

@section('title', 'Gestion de Productos')

@section('content')
<div class="container flex-center">

    @include('forms.products.create')
    @include('messages.flash_message')
    @include('admin.messages.success_message')
    @include('admin.messages.failed_message')
    
    <div class="table-content">

        <div class="list-header">

            <div class="table-title">
                <h2>Lista de Productos</h2>
            </div>

        </div>

        <table id="products-table" class="products-table">

            <thead>
                <th>
                    Código
                </th>

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


            </tbody>

        </table>

    </div>

</div>

@section('scripts')
<script>
    $('document').ready(function() {

        // inicializar tabla de productos
        const productsTable = $('#products-table').DataTable({
            paging: true,
            pagingType: "simple",
            info: false,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: "products/table",
            columns: [
                {
                    data: "id"
                },
                {
                    data: "name"
                },
                {
                    data: "cost"
                },
                {
                    data: "tax"
                },
                {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `
                              <td id="actions-row">

                                    <a href="products/${data}/edit" class="action-table action-update">
                                        Actualizar
                                    </a>
                                    <form id="actions-form" action="products/${data}" method="POST">
                                        @csrf
                                        
                                    
                                        <button type="submit" class="action-table action-delete" >
                                            Eliminar
                                        </button>

                                    </form>

                                </td>
                    
                            `;
                    },
                }

            ]
        });


    })
</script>
@endsection


@endsection