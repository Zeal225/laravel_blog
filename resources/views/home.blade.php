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
                        @foreach($articles as $article)
                            <div class="col-md-4">
                                <div style="padding: 0.6rem; background: whitesmoke; margin-bottom: 1rem">
                                    <h1>{!! $article->titre !!}</h1>
                                    <div>
                                        {!! str_limit($article->contenu, 100) !!}
                                        <div class="">
                                            {!! link_to('articles/'.$article->id, 'Lire la suite', ['class'=>'btn btn-info small']) !!}
                                        </div>
                                        <div class="">
                                            Tags:
                                            @foreach($article->tags as $value)
                                                {!! link_to('articles/tag/'.$value->tag_url, $value->tag, ['class'=>'badge badge-dark badge-pill']) !!}
                                                @endforeach
                                        </div>
                                        <p style="margin: 0.6rem">write by: {!! link_to('user/'.$article->user->id, $article->user->name) !!}</p>
                                        @auth
                                            @if(\Illuminate\Support\Facades\Auth::user()->admin && \Illuminate\Support\Facades\Auth::user()->id === $article->user_id)
                                                {!! link_to_route('articles.edit', 'Modifier l\'article', [$article->id], ['class'=>'text-success']) !!}
                                            @endif
                                        @endauth
                                        <p>
                                            Publier le: <strong>{!! $article->created_at->formatLocalized('%A %d %B %Y') !!}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          @if(isset($links))
                                {{ $links }}
                              @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
