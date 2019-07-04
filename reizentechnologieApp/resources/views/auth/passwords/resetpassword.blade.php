@extends('layouts.app')
<br>

@section('content')
    <div class="container col-md-4 background-white" style="padding-bottom: 15px; border-radius: 10px;">
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        {{ Form::open(array('action' => 'Auth\ResetPasswordController@ResetPassword', 'method' => 'post')) }}
        {{ csrf_field() }}
            <div class="form-group col-md-12">
                <label>Password: </label>
                <input type="password" class="form-control" id="password1" name="password1">
            </div>
        <div class="form-group col-md-12">
            <label>Confirm password: </label>
            <input type="password" class="form-control" id="password2" name="password2">
        </div>
            <input type="hidden" id="userid" name="userid" value="<?php echo $userid ?>">
            <input type="hidden" id="fulltoken" name="fulltoken" value="<?php echo $fulltoken ?>">
            <hr/>
        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control mb-12 ']) }}
        {{ Form::close() }}
    </div>
    </div>
@endsection()
