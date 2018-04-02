<?php
/**
 * Created by PhpStorm.
 * User: Ablo
 * Date: 01/04/2018
 * Time: 13:40
 */

namespace App\Repository;

use App\Reponse;

class ReponseRepository
{
    protected $reponse;
    public function __construct(Reponse $reponse)
    {
        $this->reponse = $reponse;
    }
    public function ajouterReponse($input)
    {
        return $this->reponse->create($input);
    }

}