<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['titre', 'contenu', 'vote', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function commentaire()
    {
        return $this->hasMany('App\Commentaire');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
