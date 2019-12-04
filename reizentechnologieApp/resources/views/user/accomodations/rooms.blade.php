@extends('layouts.app')

@section('styles')
<style>
    body, html {
        margin: 0 20px 0 20px;
        overflow-x: hidden;
        overflow-y: hidden;
        height:100vh;
    }

</style>
    
@endsection
@section('content')

<div class="d-flex justify-content-center">
    <div class="d-inline-flex ">
       
        @if(session()->has('successmessage'))
        <div class="alert alert-success">
            {{ session()->get('successmessage')}}
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
        <div class="d-flex flex-row justify-content-around">
            <div>
                <h1>kamerindeling {{$hotelName}}</h1>
            </div>
            <div>       
                <a class="btn btn-primary" href="{{route('accomodationOverviewTraveller')}}">Terug</a>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap py-3 justify-content-center" style="height: calc(100vh - 300px);">    
            
            <div class="container-fluid">
            <table class="table text-center">
                <thead>
                <tr class="row">
                    <th class="col-sm-2">kamer nr </th>
                    <th class="col-sm-2">kamerbezetting</th>
                    <th class="col-sm-8">kamerindeling</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($aRooms as $oRoom)
                <tr class="row">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-2"><h4>{{$aCurrentOccupation[$oRoom->room_id]}}/{{$oRoom->size}}</h4></td>
                    <td class="col-sm-8">
                        <button class=" btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$oRoom->room_id}}" aria-expanded="true" aria-controls="collapseExample">
                        Bekijk kamer
                        </button>
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-2"></td>
                    <td class="col-sm-8">
                        <div class="collapse" id="collapse{{$oRoom->room_id}}">
                            <div class="card card-body ">
                                <table class="table text-center">
                                <?php $i=0 ?>
                                @foreach($aTravellerPerRoom[$oRoom->room_id] as $oTraveller)
                                    <tr>
                                        <td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                            @if($oTraveller->traveller_id==$userTravellerId)
                                                {{ Form::open(array('url' => route('leaveRoomTraveller',[$oRoom->room_id]), 'method' => 'post')) }}
                                                {{ Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                {{ Form::close() }}
                                            @endif
                                        </td>
                                    </tr> 
                                    <?php $i++ ?>
                                @endforeach
                                @for($i;$i<$oRoom->size;$i++)
                                    {{ Form::open(array('url' => route('selectRoomTraveller',[$oRoom->room_id]), 'method' => 'post')) }}
                                    <tr>
                                        <td>
                                            {{Form::button('kies kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                        </td>
                                    </tr>
                                    {{Form::close()}}
                                @endfor
                                </table>
                            </div>
                        </div>
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