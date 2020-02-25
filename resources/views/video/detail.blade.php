@extends('layouts.app')

@section('content')
<div class="container">


  <div class="col-md-11 col-md-offset-2">
    <br>

    <h2 class="">{{$video->title}}</h2>
    <hr>
    <div class="col-md-8">
      <!-- video -->
      <video class="col-md-10 video" controls id='video-player' src="{{route('fileVideo', ['filename' => $video->video_path])}}" autoplay poster="posterimage.jpg">
        <!-- <source src="{{route('fileVideo', ['filename' => $video->video_path])}}" type="video/"> -->
      </video>
      <!-- descrpcion -->
      <div class="panel panel-default video-data">
        <div class="panel-heading">
          Subido por <strong><a href="{{route('channel', ['user_id' => $video->user->id])}}">{{$video->user->name}}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
          </div>
          <div class="panel-body">
            {{$video->description}}
          </div>


      </div>
      <!-- comentarios -->

        @include('video.comments')

    </div>
  </div>

</div>
@endsection
