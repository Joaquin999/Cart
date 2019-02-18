@extends('layouts.master')

@section('content')
<div class="container">

    <div class="row justify-content-center">


      <div class="row">
        <?php $msg=$msg ?? ""; ?>

        <form  method="POST" action="validar">
            {{csrf_field()}}

            <br/>

            <h1>{{__("Form validation")}}</h1>
            <p class="h3">{{ $msg ?? ""}}</p>
            <label for="nombre">{{__("Name")}}</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre')}}"/>
            {!! $errors->first('nombre','<small>:message</small>') !!}
            <br/>

            <label for="correo">{{__("Email")}}</label>
            <input type="text" name="correo" id="correo" class="form-control" value="{{ old('correo')}}"/>
            {!! $errors->first('correo','<small>:message</small>') !!}
            <br/>

            <label for="imagen">{{__("Image")}}</label>
            <input type="text" name="imagen" id="imagen" class="form-control" value="{{ old('imagen')}}"/>
            {!! $errors->first('imagen','<small>:message</small>')!!}
            <br/>

            <label for="fecha">{{__("Date")}}</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha')}}"/>
            {!! $errors->first('fecha','<small>:message</small>')!!}
            <br/>


            <input type="submit" class="btn btn-info" value="Enviar"/>
            <button class="btn btn-success">@lang('Enviar')</button>

        </form>



      </div>

      <div class="row">
        <form method="POST" action="cambiar" class="form">
          {{csrf_field()}}
          <select name="lan" id="lan">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
          </select>
          <input type="submit" value="Cambiar Idioma"/>
        </form>
      </div>




    </div>
</div>
@endsection
