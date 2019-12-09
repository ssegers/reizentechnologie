@extends('layouts.app')

@section('styles')
<style>
    .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    margin:auto;
}

.container{
    text-align: center;
}

</style>
@endsection

@section('content')

<div class="d-flex justify-content-center">
    <div class="d-inline-flex ">
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
    </div>
</div>

<div class="flex-container justify">
    <div class="d-flex flex-column overflow-auto" id="main">
        <div class="d-flex flex-row">
            @foreach($aTripsAndNumberOfAttendants as $aTripData)
                @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                    <a href="/dayplannings/overview/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
                        {{ $aTripData['name'] }} {{ $aTripData['year'] }}
                        <span class="badge badge-light">{{ $aTripData['numberOfAttends'] }}</span>
                    </a>
                @else
                    <div class="btn btn-danger badge-custom">
                        {{ $aTripData['name'] }} {{ $aTripData['year'] }}
                        <span class="badge badge-light">{{ $aTripData['numberOfAttends'] }}</span>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div>
                <h1>Accomodaties {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
            </div>
        </div>
        
    </div>
</div>

@endsection