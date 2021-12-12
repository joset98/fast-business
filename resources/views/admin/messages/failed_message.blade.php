@if (count($errors) > 0)

<div class="flash-message alert">
    <div class="flash-container">

        <div class="flash-title">
            <h2>
                Error en la accion
            </h2>
        </div>
        <div class="flash-content">
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
    </div>
</div>

@endif