<?php
/**
 * Created by PhpStorm.
 * User: Ablo
 * Date: 31/03/2018
 * Time: 23:35
 */

namespace App\Repository;


use App\Commentaire;

class CommentaireRepository
{
    protected $commentaires;
    public function __construct(Commentaire $commentaire)
    {
        $this->commentaires = $commentaire;
    }
    public function ajouterCommentaire($input)
    {
        return $this->commentaires->create($input);
    }
}