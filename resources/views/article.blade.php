@extends('layouts.app')

@section('content')
    <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>
                                                Welcome on my first laravel blog
                                                @auth
                                                {!! link_to_route('articles.create', 'Créer un article', [], ['class'=>'btn btn-success pull-right']) !!}
                                                @endauth
                                            </h2>
                                        </div>
                                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="list-article d-flex flex-row flex-lg-wrap">
                            <div class="teste">
                                <h1>
                                    {{ $article->titre }}
                                </h1>
                                <div class="panel">
                                    {{ $article->contenu }}
                                    <div class="signature">
                                        <h2>Ecris par: {!! link_to('user/'.$article->user->id, $article->user->name) !!}</h2>
                                        <p>
                                            Publier le: <strong>{!! $article->created_at->formatLocalized('%A %d %B %Y')!!}</strong>
                                        </p>
                                    </div>
                                    <p>Tags:
                                        @foreach($article->tags as $value)
                                            {!! link_to('articles/tag/'.$value->tag_url, $value->tag) !!}
                                            @endforeach
                                    </p>
                                    <div class="commentaire">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <h2>Commentaire(s) {{ link_to('#commentaire', 'Commenter') }}</h2>
                                        @foreach($commentaires as $commentaire)
                                                <p>
                                                    {!! $commentaire->contenu !!}
                                                    <br><em>
                                                        Posted by: <strong>
                                                            {!! link_to('user/'.$commentaire->user->id, $commentaire->user->name) !!}
                                                        </strong>
                                                    </em>
                                                    <span style="cursor: pointer; color: #0000F0" class="pull-right repondre" id="{!! $commentaire->id !!}">Répondre</span>
                                                </p>
                                                <br>
                                                    <div class="repondre {!! $commentaire->id !!}" style="display: none">
                                                        {!! Form::open(['route'=>'reponse.store']) !!}
                                                        <div class="form-group">
                                                            {!! Form::hidden('commentaire_id', $commentaire->id) !!}
                                                            {!! Form::hidden('article_id', $article->id) !!}
                                                            {!! Form::text('contenu', null, ['class'=>'form-control', 'placeholder'=>'entrer votre réponse']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            {!! Form::submit('Répondre', ['class'=>'btn btn-success']) !!}
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                            <div class="reponse" style="margin-left: 2.5rem">
                                                @foreach($commentaire->reponse as $contenu)
                                                   <div>
                                                       <p>
                                                           {!! $contenu->contenu !!}
                                                           <br><em>
                                                               Posted by: <strong>
                                                                   {!! link_to('user/'.$contenu->user->id, $contenu->user->name) !!}
                                                               </strong>
                                                           </em>
                                                       </p>
                                                   </div>
                                                    @endforeach
                                            </div>
                                            @endforeach
                                            {!! Form::open(['route'=>'commentaire.store']) !!}
                                                {!! Form::hidden('article_id', $article->id) !!}
                                                <div class="form-group">
                                                    {!! Form::textarea('contenu', null, ['class'=>'form-control', 'rows'=>5, 'cols'=>50, 'id'=>'commentaire','placeholder'=>'Votre commentaire ici']) !!}
                                                </div>
                                               <div class="form-group">
                                                   {!! Form::submit('Poster', ['class'=>'btn btn-primary']) !!}
                                               </div>
                                           {!! Form::close() !!}
                                        @else
                                            <div class="alert alert-warning">Pour voir les discussions liés à cet article veillez vous connecter</div>
                                        @endif
                                        </div>
                                </div>
                                <p><a class="btn btn-primary" href="javascript:history.back()">Rétour</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
