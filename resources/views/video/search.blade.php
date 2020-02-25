
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="container">
          @if(session('message'))
            <div class="alert alert-success">
              {{session('message')}}
            </div>
            @endif
                <br>
              <h2>Busqueda: {{$search}}</h2>
                <hr>
            <div class="col-md-10">
              <form class="col-md-3 pull-rigth" action="{{url('/buscar/'.$search)}}" >
                <label for="">Ordenar</label>
                <select class="form-control" name="filter">
                  <option value="new">Mas nuevos primero</option>
                  <option value="old">Mas antiguos primero</option>
                  <option value="alfa">De la  A a la Z</option>
                </select>
                <br>
                  <div class="">
                    <input type="submit" name="" value="Ordenar" class="btn btn-sm btn-primary">
                  </div>
              </form>
            </div>
            @include('video.videoList')
        </div>

    </div>
</div>
@endsection
