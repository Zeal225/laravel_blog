@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>Créer votre article</h2></div>
                    <div class="card-body">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                {{--verifie si la variable article existe donc il s'agit d'un edit--}}
                                @if(isset($article))
                                    {!! Form::model($article, ['route'=>['articles.update', $article->id], 'method'=>'put', 'class'=>'form-horizontal panel']) !!}
                                    @else
                                    {{--sinon on veut créer un article--}}
                                    {!! Form::open(['route' => 'articles.store']) !!}
                                    @endif
                                <div class="form-group">
                                    {!! Form::text('titre', null, ['class'=>'form-control', 'placeholder'=>'Entrer le titre de l\'article']) !!}
                                    {!! $errors->first('titre', '<small class="alert-link">:message</small>') !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea('contenu', null, ['class'=>'form-control', 'placeholder'=>'Entrer le contenu de l\'article']) !!}
                                    {!! $errors->first('contenu', '<small class="alert-link">:message</small>') !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::text('tag', null, ['class'=>'form-control','placeholder'=>'Ajouter des tags']) !!}
                                </div>
                                {!! Form::submit('Envoyer', ['class'=>'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection