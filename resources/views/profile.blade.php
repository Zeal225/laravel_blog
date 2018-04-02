@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Articles</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->name === $user->name)
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Modifier son profile</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">{!! $user->name !!}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Status</h5>
                            <p>
                                @if($user->admin)
                                    Administrateur
                                @else
                                Simple membre
                                    @endif
                            </p>
                            <h5>Autres infos</h5>
                            <p>
                               <strong>E-mail:</strong> {!! $user->email !!}
                            </p>
                            <p>
                                <strong>Télephone:</strong> {!! $user->contact !!}
                            </p>
                            <h5>Expérience</h5>
                            <p><strong>Membre dépuis </strong>{!! $user->created_at->formatLocalized('%A %d %B %Y') !!}</p>
                            <p>{!! $numberArticle !!}  artciles publié</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Recent badges</h6>
                            <a href="#" class="badge badge-dark badge-pill">html5</a>
                            <a href="#" class="badge badge-dark badge-pill">react</a>
                            <a href="#" class="badge badge-dark badge-pill">codeply</a>
                            <a href="#" class="badge badge-dark badge-pill">angularjs</a>
                            <a href="#" class="badge badge-dark badge-pill">css3</a>
                            <a href="#" class="badge badge-dark badge-pill">jquery</a>
                            <a href="#" class="badge badge-dark badge-pill">bootstrap</a>
                            <a href="#" class="badge badge-dark badge-pill">responsive-design</a>
                            <hr>
                            <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                            <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                            <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                        @foreach($userArticles as $userArticle)
                            <tr>
                                <td>
                                    <span class="float-right font-weight-bold">
                                        {!! $userArticle->created_at->diffForHumans() !!}
                                    </span>
                                    {!! link_to('articles/'.$userArticle->id, str_limit($userArticle->titre, ['class'=>'link']) ) !!}
                                </td>
                            </tr>
                            @endforeach
                        <tr>
                            <td>
                                @if(isset($link))
                                    {!! $link !!}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="edit">
                    {!! Form::model($user, ['route'=>['auteur.update', $user->id], 'method'=>'put']) !!}
                    <div class="form-group row">
                        <label for="" class="col-lg-3 col-form-label form-control-label">Full name</label>
                        <div class="col-lg-9">
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-3 col-form-label form-control-label">E-mail</label>
                        <div class="col-lg-9">
                            {!! Form::text('email', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-3 col-form-label form-control-label">Contact</label>
                        <div class="col-lg-9">
                            {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-3 col-form-label form-control-label">Rôle</label>
                        <div class="col-lg-9">
                            {!! Form::number('admin', null, ['class'=>'form-control', 'max'=>1, 'min'=>0]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-3 col-form-label form-control-label">Rôle</label>
                        <div class="col-lg-9">
                            {!! Form::submit('Enrégistrer les modifications', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <div class="photo">
                @if ($message = Session::get('message'))
                    <span class="alert-danger">{{ $message }}</span>
                    @endif
                @if(filter_var($user->photo, FILTER_VALIDATE_URL))
                        <img src="{!! $user->photo !!}" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                    @else
                        <img src="{{ URL::asset('/images/'.$user->photo) }}" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                    @endif
            </div>
            <h6 class="mt-2">Changer votre photo de profile</h6>
            {!! Form::open(['route'=>'auteur.photo', 'files'=>true]) !!}
          <div class="form-group">
              {!! Form::file('photo', ['class'=>'btn btn-secondary']) !!}
              {!! $errors->first('photo', '<small class="alert-link">:message</small>') !!}
          </div>
           <div class="form-group">
               {!! Form::submit('Modifier', ['class'=>'btn btn-primary']) !!}
           </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
    @endsection