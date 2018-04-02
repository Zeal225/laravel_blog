<?php
/**
 * Created by PhpStorm.
 * User: Ablo
 * Date: 26/03/2018
 * Time: 00:44
 */

namespace App\Repository;


use App\Article;
use App\User;

class UserRepository
{
    protected $users;
    protected $articles;
    public function __construct(User $user, Article $article)
    {
        $this->users = $user;
        $this->articles = $article;
    }
    public function getUser($usersId)
    {
        return $this->users->findOrFail($usersId);
    }

    public function countUserArticle($userId)
    {
        return $this->articles->where('articles.user_id', $userId)->count();
    }
    public function update($id, Array $input)
    {
        return $this->getUser($id)->update([
            'name'=>$input['name'],
            'email'=>$input['email'],
            'contact'=>$input['contact'],
            'admin'=>$input['admin']
        ]);
    }
}