<hr>

<h4>Nuevo comentario</h4>
<hr>

<div class="container">
  @if(session('message'))
    <div class="alert alert-success">
      {{session('message')}}
    </div>
    @endif
    @if(Auth::check())
    <form class="col-md-4" action="/comment" method="post">
  @csrf
    <input type="hidden" class="" name="video_id" value="{{$video->id}}" required>
  <p>
    <textarea name="body" class="form-control" rows="4" cols="40"></textarea>
  </p>

    <input type="submit" name="" value="Comentar" class="btn btn-success">
  </form>
  <div class="clearfix"></div>
  <hr>
  @endif

  @if(isset($video->comments))
    <div class="" id="comments-list">
      @foreach($video->comments as $comment)
        <div class="comment-item col-md-12 pull left">

          <div class="panel panel-default comment-data">
              <div class="panel-heading">
              Subido por <strong>{{$comment->user->name}}</strong> {{ \FormatTime::LongTimeFilter($comment->created_at) }}
              </div>
              <div class="panel-body">
                {{$comment->body}}


                @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                <div class="pull-right">
                  <br>

                  <a href="#victorModal{{$comment->id}}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>

                  <!-- Modal / Ventana / Overlay en HTML -->
                  <div id="victorModal{{$comment->id}}" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">¿Estás seguro?</h4>
                            </div>
                            <div class="modal-body">
                                <p>¿Seguro que quieres borrar este elemento?</p>
                                <p class="text-danger"><small>{{$comment->body}}</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <a href="{{url('/delete-comment/'.$comment->id)}}  " type="button" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
              <hr>


        @endforeach
    </div>
  @endif
</div>
