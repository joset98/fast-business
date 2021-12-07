@extends('layouts.guest')

@section('content')

<div class="form-content">

    <form class="product-form" id="user-form" action="{{route('login')}}" method="POST">
        @csrf
        <div class="tittle-form">
            <h1>Login</h1>
        </div>

        <div class="inputBox">
            <label for="email">Correo</label>
            <input required type="text" id="email" name="email">
        </div>

        <div class="inputBox">
            <label for="password">Password</label>
            <input required type="password" id="password" name="password">
        </div>


        <div class="inputBox submitBtn">
            <button type="submit" id="product-submit">Guardar</button>
        </div>

    </form>

</div>


@endsection