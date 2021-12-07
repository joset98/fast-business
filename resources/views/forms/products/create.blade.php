
<div class="form-content">

<form class="product-form inline-form" id="user-form" action="{{route('products.store')}}" method="POST">
    @csrf

    <div class="title-form">
        <h2>Rellene los Datos del Articulo</h2>
    </div>
    
    <input type="hidden" name="id">

    <div class="inputBox">
        <label for="name">Nombre</label>
        <input required type="text" id="name" name="name">
    </div>

    <div class="inputBox">
        <label for="cost">Costo</label>
        <input required type="number" id="cost" name="cost">
    </div>

    <div class="inputBox">

        <label for="tax">Impuesto</label>
        <input required name="tax" type="number"
            id="tax" placeholder="Impuesto"
        ></input>

    </div>

    <div class="submitBtn">
        <button type="submit" id="product-submit">Guardar</button>
        <button type="button" id="product-clear">Limpiar</button>
    </div>

</form>
</div>
