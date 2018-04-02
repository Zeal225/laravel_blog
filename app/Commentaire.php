<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ['contenu', 'user_id', 'article_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function reponse()
    {
        return $this->hasMany('App\Reponse');
    }
}
