@extends('layouts.app')

@section('content')

<div class="container">
<br>
  <div class="col">

    <h2>Editar {{$video->title}}</h2>
      <hr>
        <form class="col-lg-7" action="{{ route('updateVideo', ['video_id' => $video->id]) }}" method="post" enctype="multipart/form-data">
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
            <input type="text" class="form-control" name="title" id='title' value="{{$video->title}}">
          </div>

          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea name="description" class="form-control" id="description" rows="8" cols="80" value="">{{$video->description}}</textarea>
          </div>

          <div class="form-group">
            <label for="image">Miniatura</label>
            @if(Storage::disk('images')->has($video->image))
            <div class="video-image-thumb col-md-3 pull-left">
              <div class="video-image-mask">
                <img src="{{url('/miniatura/'.$video->image)}}" alt="foto" class="video-image">
              </div>
            </div>
            @endif
            <input type="file" class="form-control" name="image" id='image' value="">

          </div>

          <div class="form-group">
            <label for="video">Archivo de Video</label>
              <video class="col-md-10 video" controls id='video-player' src="{{route('fileVideo', ['filename' => $video->video_path])}}" autoplay poster="posterimage.jpg">
              <!-- <source src="{{route('fileVideo', ['filename' => $video->video_path])}}" type="video/"> -->
              </video>
            <input type="file" class="form-control" name="video" id='video' value="">
          </div>
            <button type="submit" class="btn btn-success" name="button">Editar Video</button>
        </form>


  </div>

</div>




@endsection
