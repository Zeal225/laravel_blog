<?php
/**
 * Created by PhpStorm.
 * User: Ablo
 * Date: 03/03/2018
 * Time: 21:39
 */

namespace App\Repository;


use App\Article;
use App\Commentaire;
use App\Reponse;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ArticleRepositoty
{
    protected $article;
    protected $users;
    protected $commentaires;
    protected $reponses;
    public function __construct(Article $article, User $user, Commentaire $commentaire, Reponse $reponse)
    {
        $this->article = $article;
        $this->users = $user;
        $this->commentaires = $commentaire;
        $this->reponses = $reponse;
    }
    public function getArticleWithUserAndTags()
    {
        return $this->article->with('user','tags')->orderBy('created_at','desc')->paginate();
    }
    public function getByID($id)
    {
         return $this->article->with('user','tags')->findOrFail($id);
    }
    public function getArticle($id)
    {
        return $this->article->findOrFail($id);
    }
    public function getCommentaireOfArticle($id)
    {
        return $this->commentaires->with('user','reponse')->where('commentaires.article_id', $id)->get();
    }
    public function getArticleOfTags($tag)
    {
        return $this->article->with('user','tags')->whereHas('tags', function ($q) use ($tag){
            $q->where('tags.tag_url', $tag);
        })->paginate();
    }
    public function getArticleOfUsers($user)
    {
        return $this->article->with('tags','user')
            ->where('articles.user_id', $user)
            ->orderBy('created_at','desc')
            ->paginate(20);
    }
    public function store($input)
    {
        return $this->article->create($input);
    }
    public function update($id, Array $inputs)
    {
        $this->getArticle($id)->update($inputs);
    }
}