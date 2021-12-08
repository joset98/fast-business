@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="container pt-2">
@include('messages.flash_message')

    <div class="content-area">

        <div class="droplist-header">

            <div class="table-title">
                <h2>Lista de Productos</h2>
            </div>

        </div>

        <div class="droplist">

            @forelse($products as $product)

            <section>

                <div class="product-card">

                    <div class="product-image">
                        <img width="200" src="{{$product->product_picture}}" alt="">

                        <div class="product-name">
                            {{$product->name}}
                        </div>

                    </div>

                    <div class="card-footer">

                        <div class="product-price">
                            <div class="product-cost">
                            Costo
                                <strong>
                                {{ $product->cost}}
                                </strong>  
                            </div>

                            <div class="product-tax">
                                Impuesto {{ $product->tax}} %
                            </div>
                        </div>

                        <div class="action-card">
                            <form class="purchase-form" action="{{route('purchases.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="action-table action-purchase">
                                    Comprar Producto
                                </button>
    
                            </form>

                        </div>

                    </div>
                </div>
            </section>
            @empty
            <div class="empty-list-message">
                <h2>
                    No hay productos disponibles, Vuelva Pronto!
                </h2>
            </div>

            @endforelse

        </div>


    </div>

</div>



@endsection