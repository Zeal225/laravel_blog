@extends('layouts.app')
@section('content')
    @foreach($data as $datum)
        <h1>{!! $datum->titre !!}</h1>
        <div class="">
            {!! $datum->contenu !!}
        </div>
    @endforeach
@endsection