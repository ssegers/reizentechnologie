@extends('layouts.app')

@section('styles')
<style>
.form-group{
    margin-top: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 70%;
</style>
@endsection

@section('content')
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
    <div class="d-flex justify-content-center">
        <h2>Algemene info aanpassen</h2>
    </div>
    <div class="form-group">
    {{ Form::open(array('url' => 'organiser\info', 'method' => 'post')) }}
    {{ Form::textArea('info_value', $oInfo->info_value, ['class' => 'form-control, html-editor']) }}
    {{ Form::submit('Opslaan') }}
    {{ Form::button('Annuleren', array('type' => 'button', 'onclick' => 'history.go(0)', 'value' => 'Annuleren')) }}
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

