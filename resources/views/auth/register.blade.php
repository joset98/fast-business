@extends('layouts.guest')

@section('content')

<div class="form-content">

    <form class="product-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="tittle-form">
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

            <input required type="password" id="password_confirmation" 
                name="password_confirmation"
            >

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