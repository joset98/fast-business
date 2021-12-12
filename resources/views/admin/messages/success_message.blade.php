@if (session('statusUpdate'))
<div class="flash-message success">
    <div class="flash-container">

        <div class="flash-title">
            <h2>
                Accion Completada
            </h2>
        </div>

        <div class="flash-content">
            {{ session('statusUpdate') }}

        </div>
    </div>

</div>
{{-- <div class="alert alert-success">
        </div>
            --}}
@endif