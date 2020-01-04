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
    <div class="d-flex flex-column flex-grow-1 overflow-auto" id="main">
    
        <div class="d-flex flex-row">

            @foreach($aTripsAndNumberOfAttendants as $aTripData)
                @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                    <a href="/transport/overview/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
                <h1>Vervoer {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary badge-custom" data-toggle="modal" data-target="#autoPopup" onclick="loadDrivers({{$oCurrentTrip->trip_id }})">Voertuig toevoegen</button>
                <a href="" class="btn btn-primary badge-custom">Export to Excel</a>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-row flex-nowrap py-3 justify-content-center overflow-auto" style="height: calc(100vh - 300px);">    
        <div class="container-fluid">
        <table class="table text-center">
            <thead>
            <tr class="row">
                <th class="col-sm-2">Bestuurder</th>
                <th class="col-sm-2">Bezettingsgraad</th>
                <th class="col-sm-6">Passagiers</th>
                <th class="col-sm-2"></th>
            </tr>
            </thead>
            <tbody>    

            @foreach ($vansPerTrip as $van)
                <tr class="row">
                    @if (empty($van->driver))
                        <td class="col-sm-2">{{ 'nog geen chauffeur voorzien' }}</td>
                    @else
                         <td class="col-sm-2">{{ $van->driver->first_name." ".$van->driver->last_name }}</td>
                    @endif
                   
                    <td class="col-sm-2"><h4>{{$occupationPerVan[$van->transport_id]}}/{{$van->size}}</h4></td>
                    <td class="col-sm-6">
                        <button class=" btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$van->transport_id}}" aria-expanded="true" aria-controls="collapseExample">
                        Bekijk passagiers
                        </button>
                    </td>
                    <td class="col-sm-2">
                        {{ Form::open(array('url' => route('deleteVan',[$van->transport_id]), 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                        {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                        {{ Form::close()}}
                    </td>
                </tr>
              
                <tr class="row">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-2"></td>
                    <td class="col-sm-6">
                        <div class="collapse" id="collapse{{$van->transport_id}}">
                            <div class="card card-body">
                                <table class="table text-center">
                                    <?php $i=0 ?>
                                    @foreach($travellersPerVan[$van->transport_id] as $traveller)
                                        <tr>
                                            <td>{{$traveller->first_name}} {{$traveller->last_name}}
                                                @if($currentTravellerId=='admin')
                                                    {{ Form::open(array('url' => route('leaveVan',[$van->transport_id, $traveller->traveller_id]), 'method' => 'post')) }}
                                                    {{ Form::button('Verlaat Voertuig',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                    {{ Form::close()}}
                                                @else
                                                    @if($traveller->traveller_id == $currentTravellerId)
                                                        {{ Form::open(array('url' => route('leaveVan',[$van->transport_id]), 'method' => 'post')) }}
                                                        {{ Form::button('Verlaat Voertuig',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                        {{ Form::close() }}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                    @if($currentTravellerId!=='admin')
                                        @for($i;$i<$van->size;$i++)
                                            {{ Form::open(array('url' => route('selectVan',[$van->transport_id]), 'method' => 'post')) }}
                                             <tr>
                                                 <td>
                                                     {{Form::button('Kies Auto',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                 </td>
                                             </tr>
                                            {{Form::close()}}
                                        @endfor
                                    @endif
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
                

<!--    modals-->
<div class="modal fade" id="autoPopup" tabindex="-1" role="dialog" aria-labelledby="autoPopupLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="hotelPopupLabel">Auto Toevoegen</h4>
                {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
            </div>
            {{ Form::open(array('action' => 'Organiser\Transport@createVan', 'method' => 'post')) }}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('Driver','Bestuurder:')}}
                    {{ Form::select('Driver', array('' => 'Selecteer een chauffeur'), null, array('class' => 'form-control','id'=>'possibleDrivers','required' => 'required')) }}
                    {{Form::label('AutoSize','Aantal passagiers:')}}
                    {{Form::number('AutoSize', null, array('class' => 'form-control','required' => 'required'))}}
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
<!--end modals-->   

@endsection
@section('scripts')

<script>
    setTimeout(function(){
        if ($('#removeTimer').length > 0) {
            $('#removeTimer').remove();
        }
    }, 5000);

    function ConfirmDelete(){
        return confirm('Bent u zeker? \nDe reizigers toegewezen aan dit vervoer moeten hierna een andere vervoer kiezen.');
    }
    
    function loadDrivers(tripId) {
        
        $.ajax({
            url: '/transport/drivers/get/'+tripId,
            type:"GET",
            dataType:"json",
            success: function( result ) {

                updateData(result['possibleDrivers']);
            },
            error: function (error) {
                console.log(error)
            }
        })
    }
    function updateData(possibleDrivers) {

        $('#possibleDrivers').empty();
        $('#possibleDrivers').append('<option value=" ">Selecteer een chauffeur</option>');
        $.each(possibleDrivers, function( index, value ) {
            $('#possibleDrivers').append('<option value="'+value['traveller_id']+'">'+value['first_name']+" "+value['last_name']+'</option>');   
        });

};

</script>
@endsection