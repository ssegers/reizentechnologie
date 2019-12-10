@extends('layouts.app')

@section('styles')
<style>

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
                <h1>Dayplannings {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary badge-custom" data-toggle="modal" data-target="#dayplanningPopup">Nieuwe dayplanning</button>
                <a href="" class="btn btn-primary badge-custom">Export to Excel</a>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-start">
            <div class="d-flex align-items-end"> 
                    
                <div class="form-group ml-md-4 ">
                    {{ Form::label('DayPlanning','dayplannings '.$oCurrentTrip->name.'*')}}
                    
                </div>
            </div>
            <div class="d-flex align-items-end"> 
                <div class="form-group ml-md-4">
                    {{ Form::button('Voeg toe aan reis',['class' => 'btn btn-primary form-control','onclick' => ""]) }}
                </div>
            </div>
                    
            <div class="d-flex align-items-end">
                <div class="form-group ml-md-4">
                    <button type="button" class="btn btn-primary" onclick="edit()"><i class="fas fa-edit"></i>edit</button>     
                </div>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 400px);">
            

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Dayplanning</th>
                            <th>Highlight</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th colspan="1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dayplanningsPerTrip as $oDayplanning)
                        <tr>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dayplanninginfoPopup" data-accomodation="{{$oDayplanning}}"><i class="fas fa-info-circle"></i></button></td>
                            <td><?php echo $oDayplanning->dayplanning_id; ?></td>
                            <td><?php echo $oDayplanning->highlight; ?></td>
                            <td><?php echo $oDayplanning->location; ?></td>
                            <td><?php echo $oDayplanning->description; ?></td>
                            <td style="width:1%; white-space:nowrap;">
                                
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection