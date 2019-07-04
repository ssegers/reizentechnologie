@extends('layouts.app')
<br>

@section('content')
<div class="container col-md-4 background-white" style="padding-bottom: 15px; border-radius: 10px;">
    @if(session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif
    
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Paswoord vergeten?</h2>
                        <p>Vul je emailadres in en je ontvangt per mail instructies om je paswoord opnieuw in te stellen.</p>
                        <div class="panel-body">
                            {{ Form::open(array('action' => 'Auth\ForgotPasswordController@EnterEmailFormPost', 'method' => 'post')) }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input id="email" name="email" placeholder="email adres invullen aub" class="form-control"  type="email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Paswoord opnieuw instellen',['class' => 'btn btn-lg btn-primary btn-block form-control mb-12 ']) }}
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

</div>
@endsection()

