@extends('layouts.guest')

@section('content')

<div class="form-content column-form-content">

    @if(count($errors) > 0 )
        <div class="alert dialog-notif register-alert" role="alert">
            <ul style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}.</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="px-1 product-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="title-form">
            <h1>Registrar Usuario</h1>
        </div>

        <div class="inputBox">
            <label for="name">Nombre</label>
            <input required type="text" id="name" name="name">
        </div>

        <div class="inputBox">
            <label for="email">Correo</label>
            <input required type="text" id="email" name="email">
        </div>

        <div class="inputBox">
            <label for="password">Password</label>
            <input required type="password" id="password" name="password">
        </div>

        <!-- Confirm Password -->
        <div class="inputBox">

            <label for="password_confirmation">
                confirmar contraseña
            </label>

            <input required type="password" id="password_confirmation" name="password_confirmation">

        </div>


        <div class="buttonBox">
            <a class="" href="{{ route('login') }}">
                Se encuentra registrado ?
            </a>


            <div class="inputBox submitBtn">
                <button type="submit" id="product-submit">
                    Registrarse
                </button>
            </div>

        </div>

    </form>
</div>

@endsection