<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Repository\ArticleRepositoty;
use App\Repository\CommentaireRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\User;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $userRepository;
    protected $commentaireRepository;

    public function __construct(ArticleRepositoty $articleRepositoty, UserRepository $userRepository, CommentaireRepository $commentaireRepository)
    {
        $this->articleRepository = $articleRepositoty;
        $this->userRepository = $userRepository;
        $this->commentaireRepository = $commentaireRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToHome()
    {
        return redirect('articles');
    }

    public function index()
    {
        $articles = $this->articleRepository->getArticleWithUserAndTags();
        $links = $articles->render();
        return view('home', compact('articles', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form/addarticle');
    }


    /**
     * @param ArticleRequest $request
     * @param TagRepository $tagRepository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request, TagRepository $tagRepository)
    {
        $input = array_merge($request->all(), ['user_id'=>$request->user()->id]);
        $articles = $this->articleRepository->store($input);
        if (isset($input['tag'])){
            $tagRepository->store($articles, $input['tag']);
        };
        return redirect(route('articles.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->getByID($id);
        $commentaires = $this->articleRepository->getCommentaireOfArticle($id);
        return view('article', compact('article','commentaires'));
//        foreach ($commentaires as $commentaire)
//        {
//            echo '<pre>'.$commentaire.'</pre>';
//        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->getByID($id);
        return view('form/addarticle', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->articleRepository->update($id, $request->all());
        return $this->redirectToHome();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function indexTag($tag)
    {
        $articles = $this->articleRepository->getArticleOfTags($tag);
        $links = $articles->render();
        return view('home', compact('articles','links'));
    }

    public function indexUser($userId)
    {
        $articles = $this->articleRepository->getArticleOfUsers($userId);
        $links = $articles->render();
        return view('home', compact('articles','links'));
    }

    public function showUser($userName)
    {
        $user = $this->userRepository->getUser($userName);
        $numberArticle = $this->userRepository->countUserArticle($userName);
        $userArticles = $this->articleRepository->getArticleOfUsers($userName);
        $link = $userArticles->render();
        return view('profile', compact('user', 'numberArticle', 'userArticles', 'link'));
    }
    public function LikeController(Request $request)
    {
       $postId = $request['postId'];
       $article = $this->articleRepository->getByID($postId);
       $likeNumber = (int) $article->vote;
//        $likeNumber = (int) $request['likeNumber'];
        $this->articleRepository->getByID($postId)->update(['vote'=>$likeNumber+1]);
        $newVote = $this->articleRepository->getByID($postId);
        return response()->json(['like'=>(int) $newVote->vote], 200);
    }
}
