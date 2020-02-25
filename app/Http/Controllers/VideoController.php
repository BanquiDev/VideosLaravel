<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;
use Auth;

class VideoController extends Controller
{
    public function createVideo(){
      return view ('video.createVideo');
    }

    public function saveVideo(Request $request){
      //dd($request->video);
      $validateData = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'image' => 'mimes:jpg,jpeg,png|max: 5000',
        //'video' => 'mimes:mp4,mpeg,avi|max: 5000',
      ]);

        $video = new Video;
        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->title;
        $video->description = $request->description;
        //subida de la imagen
        $image = $request->image;
        if($image){
          $image_path = time().$image->getClientOriginalName();
          \Storage::disk('images')->put($image_path, \File::get($image));
          $video->image = $image_path;
        }

        //subida del video
        $video_file = $request->video;

        if($video_file){
          $video_path = time().$video_file->getClientOriginalName();
          \Storage::disk('videos')->put($video_path, \File::get($video_file));
          $video->video_path = $video_path;

        }

        $video->save();

        return redirect()->route('home')->with(array(
          'message' => 'El video se ha subido correctamente!!'
        ));
    }

    public function getImage($filename){
      $file = Storage::Disk('images')->get($filename);
      return new Response($file, 200);
    }

    public function getVideoDetail($video_id){
      $video = Video::find($video_id);
      return view ('video.detail', array(
        'video' => $video
      ));
    }

    public function getVideo($filename){
      $file = Storage::disk('videos')->get($filename);
      return new Response($file, 200);
    }

    public function delete($video_id){
      $user = Auth::user();
      $video = Video::find($video_id);
      $comments = Comment::where('video_id', $video_id)->get();

      if($user && $video->user_id == $user->id){

        // eliminar comentarios
        if($comments && count($comments) >= 1){
          foreach($comments as $comment){
            $comment->delete();
          }
        }
        // eliminar ficheros
        Storage::disk('images')->delete($video->image);
        Storage::disk('videos')->delete($video->video_path);

        $video->delete();

        $message = array('message' => 'Video eliminado correctamente');

      }
      else{
        $message = array('message' => 'EL VIDEO NO SE HA ELIMINADO!!!');
      }
      return redirect()->route('home')->with($message);
    }

    public function edit($video_id){

      $user = \Auth::user();
      $video = Video::findOrFail($video_id);

      if($user && $video->user_id == $user->id){
      return view('video.edit', array(
        'video' => $video));
      }else{
        return redirect()->route('home');
      }
    }

    public function update($video_id, Request $request){

      $validateData = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'image' => 'mimes:jpg,jpeg,png|max: 5000',
        'video' => 'mimes:mp4, mpeg, avi',
      ]);

      $user = \Auth::user();
      $video = Video::findOrFail($video_id);
      $video->user_id = $user->id;
      $video->title = $request->title;
      $video->description = $request->description;

      //subida de la imagen
      $image = $request->image;
      if($image){
        $image_path = time().$image->getClientOriginalName();
        \Storage::disk('images')->put($image_path, \File::get($image));
        $video->image = $image_path;
      }

      //subida del video
      $video_file = $request->video;

      if($video_file){
        $video_path = time().$video_file->getClientOriginalName();
        \Storage::disk('videos')->put($video_path, \File::get($video_file));
        $video->video_path = $video_path;
        }

        $video->update();

        return redirect()->route('home')->with(array('message' => 'El Video se ha actualizado correctamente!!'));
    }

    public function search( Request $search){
         // dd($search);
         // dd($filter);
             $search = $search->search;
         //    $filter = $filter->filter;
         //    if (!is_null($filter->filter)) {
         //      // code...
         //
         //    $filter = $filter->filter;
         //
         //    $column = 'id';
         //    $order = 'desc';
         //
         //    if (!is_null($filter)) {
         //      if ($filter == 'new') {
         //        $column = 'id';
         //        $order = 'desc';
         //      }
         //      if ($filter == 'old') {
         //        $column = 'id';
         //        $order = 'asc';
         //      }
         //      if ($filter == 'alfa') {
         //        $column = 'title';
         //        $order = 'asc';
         //      }
         //        }
         //    }
            $videos = Video::where('title', 'LIKE', '%'.$search.'%')
                                  // ->orderBy($column, $filter)
                                  ->paginate(5);

        return view ('video.search', array(
          'videos' => $videos,
          'search' => $search,
        ));

    }
}
