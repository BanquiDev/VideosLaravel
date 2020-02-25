<div id="videos-list">
  @if(count($videos) >= 1)
    @foreach($videos as $video)
    <div class="video-item col-md-10 pull-left panel panel-default">
        <div class="panel-body">


          <!-- imagen del video -->
          @if(Storage::disk('images')->has($video->image))
          <div class="video-image-thumb col-md-3 pull-left">
            <div class="video-image-mask">
              <img src="{{url('/miniatura/'.$video->image)}}" alt="foto" class="video-image">
            </div>
          </div>
          @endif
          <div class="data">
            <h4 class="video-title"><a href="{{route('detailVideo',['video_id'=> $video->id])}}">{{$video->title}}</a></h4>
            <p><a href="{{route('channel', ['user_id' => $video->user->id])}}">{{$video->user->name}}</a> | {{ \FormatTime::LongTimeFilter($video->created_at) }}</p>
          </div>

              <a href="{{route('detailVideo',['video_id'=> $video->id])}}" class="btn btn-success">Ver</a>
            @if(Auth::check() && Auth::user()->id == $video->user->id)
              <a href="{{route('videoEdit',['video_id'=> $video->id])}}" class="btn btn-warning">Editar</a>
              <!-- Botón en HTML (lanza el modal en Bootstrap) -->
              <div class="">

                <a href="#victorModal{{$video->id}}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>

                <!-- Modal / Ventana / Overlay en HTML -->
                <div id="victorModal{{$video->id}}" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">¿Estás seguro?</h4>
                          </div>
                          <div class="modal-body">
                              <p>¿Seguro que quieres borrar este Video?</p>
                              <p class="text-danger"><small>{{$video->title}}</small></p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              <a href="{{url('/delete-video/'.$video->id)}}  " type="button" class="btn btn-danger">Eliminar</a>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            @endif
        </div>
    </div>

      @endforeach
  @else
  <div class="alert alert-warning">No hay Videos que coincidan con tu búsqueda</div>
  @endif
  <br>
  {{$videos->links()}}
</div>
