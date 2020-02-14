@extends('layouts.app')


@section('content')
<br>

<div class="container">
  <div class="col">
    <h2 align-items="center">Crear un nuevo Video</h2>
    <hr>
    <form class="col-lg-7" action="{{url('/guardar-video')}}" method="post" enctype="multipart/form-data">
      @csrf

      @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="form-group">
        <label for="Titulo">Titulo</label>
        <input type="text" class="form-control" name="title" id='title' value="{{old('title')}}">
      </div>

      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <textarea name="description" class="form-control" id="description" rows="8" cols="80" value="">{{old('description')}}</textarea>
      </div>

      <div class="form-group">
        <label for="image">Miniatura</label>
        <input type="file" class="form-control" name="image" id='image' value="">
      </div>

      <div class="form-group">
        <label for="video">Archivo de Video</label>
        <input type="file" class="form-control" name="video" id='video' value="">
      </div>
        <button type="submit" class="btn btn-success" name="button">Crear Video</button>
    </form>


  </div>
</div>
@endsection
