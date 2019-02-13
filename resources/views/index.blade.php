@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">


      <div class="row">
        @foreach($productos as $key)


            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ $key->image}}" height="250px" width="125px">
              <div class="card-body">
                <h5 class="card-title">{{$key->name}}</h5>
                <p class="card-text">{{$key->description}}</p>
                <button class="btn btn-success">Precio: {{$key->price}} €</button></a><br/><br/>
                <a href="{{ route('cart-add', $key->id)}}"><button class="btn btn-warning">Lo quiero</button></a>
                <button class="btn btn-primary">Detalles</button>
              </div>
            </div>


        @endforeach
      </div>



    </div>
</div>
@endsection
