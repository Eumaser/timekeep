<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $fillable = [
        'time_in', 'time_out',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
