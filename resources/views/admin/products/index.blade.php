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
            columns: [{
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


        $('#user-form').submit(function(evt) {

            evt.preventDefault();
            const userForm = $('#user-form');
            const route = userForm.attr('action');
            // const dataString = userForm.serialize()
            const formProduct = new FormData(evt.target);

            $.ajax(route, {
                type: 'POST',
                data: formProduct,
                processData: false,
                contentType: false,
                success: function(result) {
                    resetIfEmpty();
                    const {
                        data: {
                            message,
                            new_product
                        }
                    } = result;
                    const {
                        name,
                        cost,
                        tax,
                        id
                    } = new_product;
                    const productUrl = `{{ url('/products') }}` + `/${id}`;
                    initFlashMessage(message)
                    productsTable.ajax.reload();
                    evt.target.reset()
                },

                error: function(error) {
                    const {
                        message,
                        errors
                    } = JSON.parse(error.responseText);
                    console.log(errors)
                    const textError = errors.length > 1 ? 'Error al registrar el producto' : errors[0];
                    initFlashMessage(message, textError)
                },
                complete: function() {
                    setTimeout(function() {
                        $('.flash-message').addClass('none-message')
                        $('.flash-message').removeClass('success')
                        $('.flash-message').removeClass('alert')
                    }, 2000)
                }
            });
        })

    })
</script>
@endsection


@endsection