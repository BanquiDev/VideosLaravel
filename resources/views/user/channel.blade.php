@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

          <div class="container">

              <h2>Busqueda: {{$user->name.' '.$user->surname }}</h2>


            <div class="clearfix"></div>
            @include('video.videoList')
          </div>
        </div>
    </div>
</div>



@endsection
