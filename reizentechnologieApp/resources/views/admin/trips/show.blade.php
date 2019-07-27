@extends('layouts.admin')
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
    
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('errormessage'))
    <div class="alert alert-danger">
        {{ session()->get('errormessage') }}
    </div>
@endif

<div class="flex-container justify">      

    <div class="d-flex flex-column overflow-auto" id="main" style="height: calc(100vh - 240px);">
        <div class="d-flex flex-row flex-wrap">
        <h1 class="d-flex p-2">Beheer reizen</h1>
        <p class="d-flex p-2 align-self-end">Hier vind je alle reizen. Reizen 
            die actief zijn daar kan men zich voor registreren en al de gegevens van raadplegen
        </p>
        <div class="d-flex p-3 ml-auto">
            <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="-1">
                Voeg een reis toe
            </button>
        </div>
        </div>
        <div class="table-responsive" >
            <table id="trips" class="table table-striped table-hover nowrap compact table-sm">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Jaar</th>
                    <th>Prijs</th>
                    <th>Actief</th>
                    <th>Mail contactpersoon</th>
                    <th>Bewerken</th>
                </tr>
                </thead>

                <tbody>
                @foreach($trips as $oTrip)
                    <tr>
                        <td >{{$oTrip->name}}</td>
                        <td >{{$oTrip->year}}</td>
                        <td>&euro; {{$oTrip->price}}</td>
                        @if($oTrip->is_active)
                            <td >ja</td>
                        @else
                            <td >neen</td>
                        @endif
                        <td >{{$oTrip->contact_mail}}</td>
                        <td ><button type="button" class="btn btn-primary" data-toggle="modal" 
                            data-target="#tripModal" data-trip-id="{{$oTrip->trip_id}}" 
                            data-trip-name="{{$oTrip->name}}" data-trip-year="{{$oTrip->year}}" 
                            data-trip-active="{{$oTrip->is_active}}" data-trip-price="{{$oTrip->price}}" 
                            data-trip-mail="{{$oTrip->contact_mail}}">Edit</button>
                        </td>
                    </tr>
                @endForeach
                </tbody>
            </table>
        </div>
    </div>   
</div>

<div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="tripModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tripModalLabel">Reis aanmaken/editeren</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {{ Form::open(array('action' => 'Admin\TripController@UpdateOrCreateTrip', 'method' => 'post')) }}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('trip-name','Naam:')}}
                    {{Form::text('trip-name', null, array('class' => 'form-control', 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('trip-year','Jaar:')}}
                    {{Form::number('trip-year', null, array('class' => 'form-control', 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('trip-price','Prijs in Euro:')}}
                    {{Form::number('trip-price', null, array('class' => 'form-control', 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('trip-is-active','Actief:')}}
                    <input type="checkbox" class="checkbox-lg m-3" name="trip-is-active" value="1" id="trip-is-active"/>
                    {{--{{Form::checkbox('trip-is-active','1' )}}--}}
                </div>
                <div class="form-group">
                    {{Form::label('trip-mail','Mail contactpersoon:')}}
                    {{Form::text('trip-mail', null, array('class' => 'form-control'))}}
                </div>
                {{ Form::hidden('trip-id','trip-id',array('id'=>'trip-id')) }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('/js/datatables/datatables.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#trips').DataTable({
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
        },
        "order": [[ 3, "asc" ],[ 1, "desc" ]]
    } );
} );
</script>
<script>
    $('#tripModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var tripName = button.data('trip-name');
        var tripYear = button.data('trip-year');
        var tripActive = button.data('trip-active');
        var tripPrice = button.data('trip-price');
        var tripMail = button.data('trip-mail');
        console.log(tripActive);
        var tripId = button.data('trip-id');
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-body #trip-name').val(tripName);
        modal.find('.modal-body #trip-year').val(tripYear);
        modal.find('.modal-body #trip-active').val(tripActive);
        modal.find('.modal-body #trip-price').val(tripPrice);
        modal.find('.modal-body #trip-id').val(tripId);
        modal.find('.modal-body #trip-mail').val(tripMail);
        var active = $('#trip-is-active');
        if (tripActive == 1) {
            active.prop('checked', true);
        }
        else {
            active.prop('checked', false);
        }
    })
</script>
@endsection