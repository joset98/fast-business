<div class="form-content">

    <form class="product-form inline-form" id="update-product-form" 
        action="{{route('products.update',[$product->id])}}" method="POST"
    >
        {{ method_field('PUT') }}
        @csrf

        <div class="title-form">
            <h2>Actualice los Datos del Articulo</h2>
        </div>

        <input type="hidden" name="id" value="{{$product->id}}">

        <div class="column-form-content">

            <div class="inputBox">
                <label for="name">Nombre</label>
                <input required type="text" id="name" name="name" value="{{$product->name}}">
            </div>

            <div class="inputBox">
                <label for="cost">Costo</label>
                <input required type="number" id="cost" name="cost" value="{{$product->cost}}">
            </div>


            <div class="inputBox">

                <label for="tax">Impuesto</label>
                <input required name="tax" type="number" max="100" id="tax" value="{{$product->tax}}" placeholder="Impuesto"></input>

            </div>

            <div class="inputBox">

                <label for="stock">Stock</label>
                <input required name="stock" type="number" id="stock" value="{{$product->stock}}" placeholder="Cantidad Dispoinble">
                </input>

            </div>
        </div>


        <div class="submitBtn">
            <button type="submit" id="product-submit">Guardar</button>
        </div>

    </form>
</div>