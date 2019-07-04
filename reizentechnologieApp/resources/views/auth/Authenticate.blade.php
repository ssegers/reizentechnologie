@extends('layouts.app')
@section('content')
    <br>
    <div class="container rounded col-sm-auto col-md-6 col-xl-4 bg-white">
     
        <h1>Log in</h1>
        <hr/>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @endif
        @if(session()->has('errormessage'))
            <div class="alert alert-danger">
                {{ session()->get('errormessage') }}
            </div>
        @endif

        {{ Form::open(array('action' => 'Auth\AuthController@login', 'method' => 'post')) }}
        {{ csrf_field() }}
        <div class="form-group col-md-12">
            <label>Gebruikersnaam: </label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        </br>
        <div class="form-group col-md-12">
            <label>Paswoord: </label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <hr/>
        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control mb-12 ']) }}
        <a href="{{ route('showreset')}}">Forgot password</a>
        {{ Form::close() }}
    </div>
@endsection()