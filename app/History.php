<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'news_id' => 'rerquired',
    'edited_at' => 'required',
  );
}
