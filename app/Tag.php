<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag','tag_url'];
    public function article()
    {
        return $this->belongsToMany('App\Article');
    }
}
