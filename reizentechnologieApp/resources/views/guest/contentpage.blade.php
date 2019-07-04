@extends('layouts.app')

@section('content')
    @if($page->type=="pdf")
        <div class="embed-responsive embed-responsive-4by3">
            
            <embed class="embed-responsive-item" id="preview" src="{{ $page->content }}" type='application/pdf'>
        </div>
    @else
        <div class="container">
            {!!$page->content!!}
        </div>
    @endif
@endsection