<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fast Business - @yield('title')</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
</head>

<body>
    <div>
        <header class="nav-header">
            @auth
            @if( auth()->user()->role == 'ADMIN')

            @include('layouts.navigation')
            @endif
            
            @if( auth()->user()->role == 'CLIENT')
                @include('layouts.clients.navigation')
            @endif
            @endauth

        </header>
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
<script>
    
    $('#user-form').submit(function (evt) {

        evt.preventDefault();
        const userForm = $('#user-form');
        const route = userForm.attr('action');
        const dataString = userForm.serialize()
        console.log(dataString)
        console.debug(userForm)

        $.ajax(route, {
            type: 'POST',
            data: dataString,
            success: function (result) {
                const { data:{message, new_product} } = result;
                const {name, cost, tax, id} = new_product;
                const productUrl = `{{ url('/products') }}` + `/${id}`;
                console.log(productUrl)
                initFlashMessage(message)
                $('.products-btable').append(
                    `
                    <tr>
                        <td>
                            ${name}
                        </td>

                        <td>
                            ${cost}
                        </td>

                        <td>
                            ${tax} %
                        </td>

                        <td id="actions-row">
                        <form id="actions-form" action="${productUrl}" method="POST">
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
                    `
                );

                console.log(message)
                console.log(new_product)
            },

            error: function (error) {
                const { message, errors } = JSON.parse(error.responseText);
                console.log(errors)
                const textError = errors.length > 1 ? 'Error al registrar el producto' : errors[0];
                initFlashMessage(message, textError)
            },
            complete:function(){
                setTimeout(function () {
                    $('.flash-message').addClass('none-message')
                    $('.flash-message').removeClass('success')
                    $('.flash-message').removeClass('alert')
                }, 2000)
            }
        });
    })

</script>
</body>

</html>