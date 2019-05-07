<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

  public function artists(){
    return $this->hasMany('App\Artist');
  }

  protected $fillable = [
    'user_id', 
    'event_name',
    'location_name',
    'location_url',
    'open_date',
    'event_open',
    'event_start',
    'ticket_price',
    'supplement',
    'contact_number',
    'contact_mail',
    'cap_none_num'
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];
}
