@extends('layouts.guest')

@section('content')

<div class="form-content">


    <form class="login-form column-form-content" id="user-form" action="{{route('login')}}" method="POST">
        @csrf
        <div class="title-form">
            <h1>Login</h1>
        </div>
        <div class="login-fields">
            <div class="inputBox">
                <label for="email">Correo</label>
                <input required type="text" id="email" name="email">
            </div>

            <div class="inputBox">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password">
            </div>

        </div>

        @if(count($errors) > 0 )
            <div class="alert dialog-notif alert-danger login-alert alert-dismissible fade show" 
                role="alert"
            >
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="inputBox submitBtn fixed-bottom">
            <button type="submit" class="submit-login" id="product-submit">Guardar</button>
        </div>

    </form>

</div>


@endsection