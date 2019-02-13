@extends('layouts.master')

@section('content')

<div class="container text-center">
  <div class="page-header">
    <h1><i class="fa fa-shopping-cart"></i>Carrito de compras</h1>
  </div>

<?php $cart=$cart ?? []; ?>
@if(count($cart))

<p>
  <a href="{{ route('cart-trash')}}" class="btn btn-danger">
    Vaciar carrito<i class="fa fa-trash"></i>
  </a>
</p>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Quitar</th>

        </tr>
      </thead>
      <tbody>

          @foreach($cart as $item)
          <tr>
              <td><img src="{{ $item->image }}" height="150px" width="150px"/></td>

              <td>{{$item->name}}</td>
              <td>${{ number_format($item->price,2)}}</td>
              <td>
                <form action="{{url('cart/update/'. $item->id)}}" method="POST">
                  {{csrf_field()}}
                <input type="number" min="1" max="100" value="{{ $item->quantity}}" name="p_{{ $item->id}}" />
                <button type="submit" class="btn btn-warning btn-update-item">
                  <i clas="fa fa-refresh"></i>
                </button>
              </form>
                </td>
              <td>${{ number_format($item->price * $item->quantity, 2)}}</td>
              <td>
                <a href="{{ url('cart/delete/'.$item->id) }}" class="btn btn-danger">
                  <i class="fa fa-remove"></i>X
                </a>
              </td>
            </tr>
            @endforeach
      </tbody>
    </table><hr/>
    <h3>
      <span class="label label-success">
        Total: ${{ number_format($total,2)}}
      </span>
    </h3>
  </div>

  @else
      <h3><span class="label label-warning">No hay productos en el carrito</span></h3>
  @endif
  <hr>
  <p>
    <a class="btn btn-primary" href="{{ route('home') }}">
      <i class="fa fa-chevron-circle-left"></i>
      Seguir comprando</a>
    <a class="btn btn-primary" href="{{ route('home') }}">
      <i class="fa fa-chevron-circle-left"></i>
      Continuar</a>
  </p>

</div>
@stop
