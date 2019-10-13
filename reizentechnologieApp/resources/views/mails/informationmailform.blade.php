@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('alert-message'))
        <div class="alert alert-danger">
            {{ session()->get('alert-message') }}
        </div>
    @endif
    @csrf
    <div class="container">
        <h1>Mail naar alle deelnemers:</h1><br />
        {{ Form::open(array('route' => 'sendemail', 'method' =>'post', "onsubmit" => 'return confirm("Bent u zeker dat u de mail wilt versturen?")')) }}
        <div class="form-group">    
            {{ Form::label('test', 'Verstuur test mail') }}
            {{ Form::checkbox('test', 'sendTestMail',false) }}
        </div>
        <div class="form-group">
            {{ Form::label('subject', 'Onderwerp:') }}
            {{ Form::text('subject', '', ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('trip', 'Reis:') }}
            {{ Form::select('trip',$aTrips,'' ,array('id' => 'contact-select', 'class' => 'form-control', 'required'))}}
        </div>
        <div class="form-group">
            {{ Form::label('contactMail','Email Contactpersoon:') }}
            {{ Form::text('contactMail', $sEmail, array("class" => "form-control", 'readonly')) }}
            {{--<input class="form-control" disabled="disabled" id="email-field"/>--}}
        </div>
        <div class="form-group">
            {{ Form::label('message', 'Bericht:') }}
            {{ Form::textArea('message', '', ['class' => 'form-control, html-editor', 'required']) }}
        </div>
        {{ Form::submit('Verzend',array("class" => "btn btn-primary")) }}
        {{Form::button('Annuleren', array("class" => "btn btn-danger", "onclick" => "history.go(0)"))}}
        {{ Form::close() }}
    </div>


@endsection
@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
  
    <script>

    $( 'textarea.html-editor' ).ckeditor({
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
        contentsCss: '{{ asset("css/app.css") }}',
        height: '200px',
        width: '98%'
    });

    </script>
@endsection