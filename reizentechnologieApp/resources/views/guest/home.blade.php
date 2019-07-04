@extends('layouts.app')
@section('styles')
<style>
    .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    margin:auto;
}
   </style>
@endsection
@section('content')
<div class="container">
    <div class="d-flex flex-row justify-content-center">
        <div class="p-2">
            <div id="images" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- slideshow images -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/header1.jpg') }}" class="img-fluid" alt="header 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/header2.jpg') }}" class="img-fluid" alt="header 2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-end">
        <div class="p-2">
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
        {!!$page->content!!}
        </div>
    </div>
</div>
@endsection