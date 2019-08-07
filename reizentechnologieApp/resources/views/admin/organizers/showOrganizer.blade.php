@extends('layouts.admin')

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

    <div class="d-flex flex-row justify-content-center">
        <h1 class="d-flex p-2">Koppel organisatoren aan actieve reizen.</h1>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex">
            {{ Form::select('dropDownActiveTrips', $aActiveTrips, $iTripId,['required','id'=>'dropReis', 'placeholder' => 'Selecteer een reis', 'class' => 'mb-2 form-control '])}}
        </div>        
    </div>
    <div class="d-flex flex-row">
        <h2 class="d-flex p-2">Organisators</h2>
        <div class="d-flex p-2 ml-auto">
            <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#organizerPopup">
                <i class="fas fa-plus-circle fa-2x"></i>
            </button>
        </div>
    </div>

    <div class="d-flex flex-row">
        <table class="table organizerTable">
            <thead>
                <tr>
                    <th scope="col">Voornaam</th>
                    <th scope="col">Achternaam</th>
                    <th scope="col">Actie</th>
                </tr>
            </thead>
            <tbody>

            @foreach($aOrganizers as $aOrganizer)
                <tr>
                <td>
                    {{$aOrganizer['first_name']}} 
                </td>
                <td>
                   {{ $aOrganizer['last_name']}}
                </td>
                <td>
                    <button class="btn btn-primary p-2 mx-auto" onclick="deleteActiveOrganizer({{$aOrganizer['traveller_id']}})">
                        <i class="fas fa-minus-circle fa-2x"></i></button>
                </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <!-- MODAL POPUP -->
    <div class="modal" id="organizerPopup" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Organisators</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">
                              Naam
                            </th>
                            <th scope="col">
                              Toevoegen?
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aGuides as $aGuide)
                            <tr>
                            <td>
                                {{$aGuide['first_name']}} {{$aGuide['last_name']}}
                            </td>
                            <td>

                            <input type="checkbox" class="organizersCheckbox checkbox-lg"  name="{{$aGuide['traveller_id']}}" value="{{$aGuide['traveller_id']}}">

                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addActiveOrganizer()">Opslaan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<!--    <script src="{{ URL::asset('js/activeTripOrganiser.js') }}"></script>-->
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('select[name="dropDownActiveTrips"]').on('change', function(){
        var tripId = $(this).val();
        if (tripId != 0){
        $.ajax({
                url: '/admin/organizers/get/'+tripId,
                type:"GET",
                dataType:"json",
                success: function( result ) {
                var data = result['aOrganizers'];
                buildTable(data);
            }
        });
        
        }else{
            data = [];
            buildTable(data);
        }
    });


});

function buildTable(data) {
    $(".organizerTable tbody > tr").remove();

    for (let i = 0; i < data.length; i++) {
        $(".organizerTable tbody").append('<tr>' +
            '<td>' + data[i].first_name + '</td>' +
            '<td>' + data[i].last_name + '</td>' +
            '<td>' +
            '<button class="btn btn-primary p-2 mx-auto" onclick="deleteActiveOrganizer(this,' + data[i].traveller_id + ')">' +
            '<i class="fas fa-minus-circle fa-2x"></i></button>' +
            '</td>' +
            '</tr>');
    }
};

function addActiveOrganizer() {
        var checkedVals = $('.organizersCheckbox:checkbox:checked').map(function() {
            return this.value;
        }).get();
    var trip_id =  $('select[name="dropDownActiveTrips"]').val();

    // Send this data to a script somewhere via AJAX
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/admin/organizers/add",
        data: {
            trip_id: trip_id,
            traveller_ids: checkedVals,
        },
        success: function(msg){
            window.location.replace("/admin/organizer/"+trip_id);
        }
    })
}

function deleteActiveOrganizer(e,traveller_id) {
    var trip_id =  $('select[name="dropDownActiveTrips"]').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: "/admin/organizer/delete",
        data: {
            trip_id: trip_id,
            traveller_id: traveller_id,
        },
        success: function(msg){
            window.location.replace("/admin/organizer/"+trip_id);
        }
});
}
</script>
@endsection