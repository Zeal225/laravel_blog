<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = ['contenu', 'commentaire_id', 'user_id'];
    public function commentaire()
    {
        return $this->belongsTo('App\Commentaire');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
