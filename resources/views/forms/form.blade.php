
<div class="form-content">

<form class="product-form" id="user-form" action="{{route('products.store')}}" method="POST">
    @csrf
    <div class="tittle-form">
        <h2>Datos del Articulo</h2>
    </div>

    <div class="inputBox">
        <label for="name">Nombre</label>
        <input required type="text" id="name" name="name">
    </div>

    <div class="inputBox">
        <label for="cost">Costo</label>
        <input required type="number" id="cost" name="cost">
    </div>

    <div class="inputBox">

        <label for="description">Descripcion</label>
        <textarea required name="description" 
            id="description" rows="10" cols="50" placeholder="Write here"
        ></textarea>

    </div>

    <div class="inputBox submitBtn">
        <button type="submit" id="product-submit">Guardar</button>
    </div>

</form>
</div>

