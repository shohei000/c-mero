<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model

{

  use SoftDeletes;

  public function event(){
    return $this->belongsTo('App\Event');
  }
   
  protected $dates = [ 'deleted_at' ];

  protected $fillable = [
    'id', 
    'event_id',
    'artist_name',
    'artist_youtube',
    'artist_tw',
    'artist_cap',
    'delete_flg',
    'cap_delete_flg',
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];
}
