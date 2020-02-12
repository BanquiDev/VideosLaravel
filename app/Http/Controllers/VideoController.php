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
      $validateData = $this->validate($request, [
        'title' => 'required|min:5',
        'description' => 'required',
        'image' => 'mimes:jpg,jpeg,png|max: 5000',
        'video' => 'mimes:mp4,mpeg,avi|max:10000'
      ]);

        $video = new Video;
        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->title;
        $video->description = $request->description;

        $image = $request->image;
        if($image){
          $image_path = $image->getClientOriginalName();
          \Storage::disk('images')->put($image_path, \File::get($image));
          $video->image = $image_path;
        }


        $video->save();

        return redirect()->route('home')->with(array(
          'message' => 'El video se ha subido correctamente!!'
        ));
    }
}
