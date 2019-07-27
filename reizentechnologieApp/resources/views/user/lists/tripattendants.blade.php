@extends('layouts.app')

@section('styles')
<style>
    body, html {
  margin: 0;
  overflow-x: hidden;
  overflow-y: hidden;
  height:100vh;
 
}
</style>
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/datatables/datatables.min.css') }}"/>
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
{{Form::open(array('url' => "organiser/partisipantslist/$oCurrentTrip->trip_id", 'method' => 'post'))}}
    
<div class="flex-container justify">
        
    <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 220px);">
        <div class="d-flex flex-column col-auto overflow-auto" id="left">
            <div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="button-filter" value="button-filter" class="btn btn-primary">Selectie toepassen</button>          
                </div>
                <div class="form-group">                   
                    @foreach($aFilterList as $sFilterName => $sFilterText)
                    <div class="d-flex justify-content-between">                       
                        <div>{{ $sFilterText }}</div>
                        <div>
                            @if(array_key_exists($sFilterName, $aFiltersChecked))
                                {{ Form::checkbox($sFilterName, null, true) }}
                            @else
                                {{ Form::checkbox($sFilterName, null, false) }}
                            @endif
                        </div>
                    </div>
                    @endForeach
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-grow-1 overflow-auto" id="main">
            <div class="d-flex flex-row">
                @foreach($aTripsAndNumberOfAttendants as $aTripData)
                    @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                        <a href="/organiser/partisipantslist/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
                    <h1>Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="export" value="pdf">PDF</button>
                    <button class="btn btn-primary" type="submit" name="export" value="excel">Excel</button>
                </div>
            </div>

            <div class="d-flex flex-row">
                       
                <div class="table-responsive" >
                    <table id="tripattendees" class="table table-striped table-hover nowrap compact table-sm">
                        <thead>
                        <tr>
                            <th>edit</th>
                            @foreach($aFiltersChecked as $sFilterValue)
                                <th>{{ $sFilterValue }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aUsers as $aUserData)
                            <tr>
                                <td>
                                    <button id="editButton" type="button" class="open btn-primary rounded btn-xs" 
                                                    onclick="edituser( '{{$oCurrentTrip->trip_id}}','{{ $aUserData['username'] }}')">
                                        <i class="fas fa-edit"></i>                                    
                                    </button>
                                </td>
                                @foreach($aFiltersChecked as $sFilterName => $sFilterText)
                                    <td>{{ $aUserData[$sFilterName] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>              
            </div>    
        </div>  
    </div>
</div>
{{ Form::close() }}
@endsection
@section('scripts')
<script src="{{ mix('/js/datatables/datatables.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#tripattendees').DataTable({
        "language": {
            "lengthMenu": "Toon _MENU_ rijen/pagina",
            "zeroRecords": "Geen gegevens gevonden - sorry",
            "info": "pagina _PAGE_ van _PAGES_",
            "infoEmpty": "geen gegevens beschikbaar",
            "infoFiltered": "(gefilterd uit een totaal van _MAX_ rijen)",
            "search":         "zoeken:",
            "paginate": {
                "first":      "Eeste",
                "last":       "Laatste",
                "next":       "Volgende",
                "previous":   "Vorige"
            },
            "decimal":        ",",
            "thousands": "."          
        }
    } );
} );    
    function edituser(tripid, userid) {
        window.location.href = '<?php echo url('/') ?>/organiser/showpartisipant/' + tripid +'/'+ userid;
    }
</script>
@endsection