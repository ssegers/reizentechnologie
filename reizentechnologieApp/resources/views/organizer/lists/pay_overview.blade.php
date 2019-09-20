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

<div class="flex-container justify">
    <div class="d-flex flex-column overflow-auto" id="main">
        <div class="d-flex flex-row">

            @foreach($aTripsAndNumberOfAttendants as $aTripData)
                @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                    <a href="/payments/overview/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
            <div class="d-none d-sm-block">
                <h1>Betalingen {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary badge-custom">Studenten betalingsstatus mailen</button>
                <a href="{{ route('exportpayments',$oCurrentTrip->trip_id)}}" class="btn btn-primary badge-custom">Export to Excel</a>
            </div>
            </div>
            
        </div>
        <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 340px);">
            <div class="table-responsive" >
                <table id="paymentStatusTable" class="table table-striped table-hover compact table-sm">
                    <thead>
                        <tr>
                            <th class="th-sm">ID nummer</th>
                            <th class="th-sm">Naam</th>
                            <th class="th-sm">Voornaam</th>
                            <th class="th-sm">Bankrekening</th>
                            <th class="th-sm">Totaal</th>
                            <th class="th-sm">Reeds betaald</th>
                            <th class="th-sm">Saldo (te betalen)</th>
                            <th class="th-sm">Betaling</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userdata as $aUser)
                        <tr>
                            <td class="field">{{ $aUser['username'] }}</td>
                            <td class="field">{{ $aUser['last_name'] }}</td>
                            <td class="field">{{ $aUser['first_name'] }}</td>
                            <td class="field">{{ $aUser['iban'] }}</td>
                            <td class="field">{{ $aUser['price'] }}</td>
                            <td class="field">{{ $aUser['totalpaid'] }}</td>
                            <td class="field">{{ $aUser['price']-$aUser['totalpaid'] }}</td>
                            <td class="field"> <button id="modalButton-{{$aUser['traveller_id']}}" type="button" class="open btn-primary rounded btn-xs  " data-lastname="{{$aUser['last_name']}}"
                                                       data-firstname="{{$aUser['first_name']}} "data-toggle="modal" data-target="#paymentPopUp" onclick="loadPaymentData({{$aUser['trip_id']}},{{$aUser['traveller_id']}})">

                                    <i class="fas fa-plus-circle "></i>
                                </button></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="paymentPopUp" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Overzicht betalingen : </h5>
                <h5 class="modal-title" id="modal-user"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="paymentOverviewTable" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Bedrag</th>
                        <th>Verwijderen?</th>
                    </tr>
                    </thead>
                    <tbody id="paymentdata">

                    </tbody>
                </table>
                    {{Form::open(array('submit' => 'post','action'=>'DataController@addPayment','id' => 'addPaymentForm'))}}
                    @csrf
                    {{Form::hidden('traveller_id','', array("id"=>"traveller_id"))}}
                    {{Form::hidden('trip_id','', array("id"=>"trip_id"))}}
                <div class="form-group col">
                    {{Form::label('payment_date', 'Betalingsdatum ', ['class' => ''])}}
                    {{Form::text('payment_date', null, ['id'=>'payment_date','type'=>'date', 'class' => 'form-control', 'required', 'placeholder' => 'JJJJ-MM-DD' ,'pattern' =>'([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))', 'title' => 'JJJJ-MM-DD'])}}
                </div>
                <div class="form-group col">
                    {{Form::label('amount', 'Betaling: ', ['class' => ''])}}
                    {{Form::number('amount', null, array("id"=>"amount","class" => "form-control", "required", "min" => "0", "oninvalid" => "this.setCustomValidity('Deze betaling is ongeldig')", "oninput" => "this.setCustomValidity('')" )) }}
                </div>
            </div>

            <div class="modal-footer">
                {{Form::submit('Betaling toevoegen', ['class' =>'btn btn-primary' ])}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload()">Sluiten</button>
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
    
    $('#paymentStatusTable').DataTable({
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
        "order": [[ 5, "desc" ],[ 1, "asc" ]]
    } );
          
    $('#addPaymentForm').submit(function (e) {
            e.preventDefault();           
            addPayment();
    });
} )


function loadPaymentData(tripId,travellerId) {
    var buttonId = 'modalButton-'+travellerId;
    var button = document.getElementById(buttonId);
    document.getElementById('modal-user').innerHTML = button.dataset.firstname+' '+button.dataset.lastname;
    
        $.ajax({
            url: '/payments/get/'+tripId+'/'+travellerId,
            type:"GET",
            dataType:"json",
            success: function( result ) {
               
                updateData(result['aPayments'],tripId,travellerId);
            },
            error: function (error) {
                console.log(error)
            }
        })

}

function updateData(paymentData,tripId,travellerId) {
    
    document.getElementById("traveller_id").value = travellerId;
    document.getElementById("trip_id").value = tripId;
    $('#paymentdata').empty();
        for(var i = 0; i < paymentData.length; i++){
        var payment = paymentData[i];
        $('#paymentdata').append($('<tr>')
            .append($('<td>').text(payment.date_of_payment))
            .append($('<td>').text(payment.amount))
            .append($('<td>').append($('<button>')
                .text('Delete')
                .attr('class', 'btn btn-primary')
                .attr('onClick', ("deletePayment(" + payment.payment_id + "," + payment.traveller_id + "," + payment.trip_id + ")"))
            )));   
    };

};

function deletePayment(paymentId, travellerId, tripId) {
    if(confirm('Bent u zeker?')){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/payments/delete",
            data: {
                payment_id: paymentId,
            },
            success:function (result) {
                loadPaymentData(tripId,travellerId);
            },

            error: function (error) {
                console.log(error)
            }


        })
    }
};
function addPayment() {

    var datastring = $("#addPaymentForm").serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : '{{route('addPayment')}}',
        data : datastring,

        success: function(result){
            document.getElementById("payment_date").value = "",
            document.getElementById("amount").value = "",
            loadPaymentData(document.getElementById("trip_id").value,document.getElementById("traveller_id").value);
        },
        error: function (xhr, message) {
            alert(xhr.status);
            alert(message);
        }
    });

  };  
    
</script>

@endsection