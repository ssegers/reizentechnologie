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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoomsToAccomodationPopup">Kamers toevoegen</button>
                <a class="btn btn-primary" href="{{route('accomodationOverview',[$tripId])}}">Terug</a>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap py-3 justify-content-center" style="height: calc(100vh - 300px);">    
            
            <div class="container-fluid">
            <table class="table text-center">
                <thead>
                <tr class="row">
                    <th class="col-sm-2">kamer nr </th>
                    <th class="col-sm-2">kamerbezetting</th>
                    <th class="col-sm-6">kamerindeling</th>
                    <th class="col-sm-2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($aRooms as $oRoom)
                <tr class="row">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-2"><h4>{{$aCurrentOccupation[$oRoom->room_id]}}/{{$oRoom->size}}</h4></td>
                    <td class="col-sm-6">
                        <button class=" btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$oRoom->room_id}}" aria-expanded="true" aria-controls="collapseExample">
                        Bekijk kamer
                        </button>
                    </td>
                    <td class="col-sm-2">
                        {{ Form::open(array('url' => route('deleteRoom',[$oRoom->room_id]), 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                        {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                        {{ Form::close()}}
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-2"></td>
                    <td class="col-sm-6">
                        <div class="collapse" id="collapse{{$oRoom->room_id}}">
                            <div class="card card-body ">
                                <table class="table text-center">
                                <?php $i=0 ?>
                                @foreach($aTravellerPerRoom[$oRoom->room_id] as $oTraveller)
                                    <tr>
                                        <td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                            @if($userTravellerId=='admin')
                                                {{ Form::open(array('url' => route('leaveRoom',[$oRoom->room_id, $oTraveller->traveller_id]), 'method' => 'post')) }}
                                                {{Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                {{Form::close()}}
                                            @else
                                                @if($oTraveller->traveller_id==$userTravellerId)
                                                    {{ Form::open(array('url' => route('leaveRoom',[$oRoom->room_id]), 'method' => 'post')) }}
                                                    {{ Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                    {{ Form::close() }}
                                                @endif
                                            @endif

                                        </td>
                                    </tr> 
                                    <?php $i++ ?>
                                @endforeach
                                @for($i;$i<$oRoom->size;$i++)
                                    {{ Form::open(array('url' => route('selectRoom',[$oRoom->room_id]), 'method' => 'post')) }}
                                    <tr>
                                        <td>{{Form::button('kies kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                        </td>
                                    </tr>
                                    {{Form::close()}}
                                @endfor
                                </table>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2"></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addRoomsToAccomodationPopup" tabindex="-1" role="dialog" aria-labelledby="addRoomsToAccomodationPopupLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><div class="modal-body">
            </div>
                <h4 class="modal-title" id="addRoomsToAccomodationPopupLabel">Hotelkamers Toevoegen</h4>
                {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
            </div>
            {{ Form::open(array('action' => 'Organiser\Rooms@addRooms', 'method' => 'post')) }}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('NumberOfRooms','Aantal Kamers:')}}
                    {{Form::number('NumberOfRooms', 1, array('class' => 'form-control','required' => 'required'))}}
                </div>   
                <div class="form-group">
                    {{Form::label('NumberOfPeople','Aantal Personen:')}}
                    {{Form::number('NumberOfPeople', null, array('class' => 'form-control','required' => 'required'))}}
                </div>
            </div>
            <div class="modal-footer">
                {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    setTimeout(function(){
        if ($('#removeTimer').length > 0) {
            $('#removeTimer').remove();
        }
    }, 5000);

    function ConfirmDelete(){
        return confirm('Bent u zeker? \nDe reizigers die al een plaats in deze hotelkamer gekozen hebben moeten hierna een andere kamer kiezen.');
    }
</script>
@endsection