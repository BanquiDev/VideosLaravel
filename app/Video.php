<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  public function comments(){
  return $this->hasMany('App\Comment')->orderBy('id', 'desc');
}

public function user(){
  return $this->belongsTo('App\User', 'user_id');

}
}
