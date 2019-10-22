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
    <div class="d-flex flex-column overflow-auto" id="main">
        <div class="d-flex flex-row">

            @foreach($aTripsAndNumberOfAttendants as $aTripData)
                @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                    <a href="/accomodations/overview/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
            <div>
                <button type="button" class="btn btn-primary badge-custom">Nieuwe accomodatie</button>
                <a href="" class="btn btn-primary badge-custom">Export to Excel</a>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-start">
           
            <div class="d-flex align-items-end"> 
                <div class="form-group">
                    

                    {{ Form::label('Destination','Bestemming*') }}
                    {{ Form::select('Destination',  $aDestinations, '' , [ 'required','id'=>'dropDestination', 'placeholder' => 'Selecteer een bestemming', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="d-flex align-items-end"> 
                    
                <div class="form-group ml-md-4 ">
                    {{ Form::label('Accomodation','Verblijfsaccomodatie*')}}
                    {{ Form::select('Accomodation', $aAccomodations, '' ,['required','id'=>'dropAccomodations', 'placeholder' => 'Selecteer eerst een bestemming', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="d-flex align-items-end"> 
                <div class="form-group ml-md-4">
                    {{ Form::submit('Voeg toe aan reis',['class' => 'btn btn-primary form-control', 'data-toggle' => "modal", 'data-target' => "#hoteltripPopup", 'data-accomodationId','onclick' => "connectHotelToTrip()"]) }}
                </div>
            </div>
        </div>
        
        <div class="d-flex flex-row justify-content-center">
            

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead
                        <tr>
                            <th></th>
                            <th>Hotel Naam</th>
                            <th>Van (check in)</th>
                            <th>Tot (check out)</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accomodationsPerTrip as $oAccomodation)
                        <tr>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hotelinfoPopup" data-hotel-name="{{$oAccomodation->hotel_name}}" data-hotel-address="{{$oAccomodation->address}}" data-hotel-phone="{{$oAccomodation->phone}}" data-hotel-email="{{$oAccomodation->email}}" ><i class="fas fa-info-circle"></i></button></td>
                            <td>{{ $oAccomodation->hotel_name }}</td>
                            <td><?php echo $dd = date("d-m-Y", strtotime($oAccomodation->pivot->start_date)); ?></td>
                            <td><?php echo $dd = date("d-m-Y", strtotime($oAccomodation->pivot->end_date)); ?></td>
                            <td style="width:1%; white-space:nowrap;">
                                {{--{{ Form::open(array('action' => '/listrooms/'.$oAccomodation->hotels_per_trip_id, 'method' => 'post')) }}--}}
                                <form method="POST" action="/hotel/listrooms/{{$oAccomodation->hotel_id}}/{{$oAccomodation->hotel_name}}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                {{ Form::submit('Bekijk kamers',array('class'=>"btn btn-primary")) }}
                                </form>
                            </td>
                            <td style="width:1%; white-space:nowrap;">
                                {{ Form::open(array('action' => 'Organiser\Accomodation@deleteHotel', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                                {{ Form::hidden('hotels_per_trip_id', $oAccomodation->hotels_per_trip_id) }}
                                {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                                {{ Form::close()}}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                

    <!--    modals-->
    <div class="modal fade" id="hotelPopup" tabindex="-1" role="dialog" aria-labelledby="hotelPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelPopupLabel">Hotel Toevoegen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\Accomodation@createHotel', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Hotelnaam','Hotelnaam:')}}
                        {{Form::text('Hotelnaam', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('EmailHotel','Email Hotel:')}}
                        {{Form::text('EmailHotel', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Adres','Adres:')}}
                        {{Form::text('Adres', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Telnr','Telnr:')}}
                        {{Form::text('Telnr', null, array('class' => 'form-control','required' => 'required'))}}
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

    <div class="modal fade" id="hoteltripPopup" tabindex="-1" role="dialog" aria-labelledby="hoteltripPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hoteltripPopupLabel">Hotel Toevoegen aan reis</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\Accomodation@addAccomodationToTrip', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::hidden('hotel_id',null,array('id'=>'hiddenHotelId'))}}
                        {{Form::hidden('trip_id',$oCurrentTrip->trip_id )}}

                        {{Form::label('checkIn','Van (check in):')}}
                        {{Form::text('checkIn', null, ['id'=>'ccheckin_date','type'=>'date', 'class' => 'form-control', 'required', 'placeholder' => 'JJJJ-MM-DD' ,'pattern' =>'([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))'])}}
                        {{Form::label('checkOut','Tot (check out):')}}
                        {{Form::text('checkOut', null, ['id'=>'ccheckout_date','type'=>'date', 'class' => 'form-control', 'required', 'placeholder' => 'JJJJ-MM-DD' ,'pattern' =>'([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))'])}}
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

    <div class="modal fade" id="hotelinfoPopup" tabindex="-1" role="dialog" aria-labelledby="hotelinfoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelinfoLabel">Hotel Info</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr><td>Naam:</td><td><p id="hotel-name"></p></td></tr>
                        <tr><td>Adres:</td><td><p id="hotel-address"></p></td></tr>
                        <tr><td>Telnr:</td><td><p id="hotel-phone"></p></td></tr>
                        <tr><td>Emailadres:</td><td><p id="hotel-email"></p></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                </div>
            </div>
        </div>
    </div>
    <!--    endmodals-->
</div>
@endsection
@section('scripts')
<script src="{{ mix('js/dropdown/cascadingDropDownDestinationAccomodation.js') }}" type="text/javascript"></script>
<script>
    $('#hotelinfoPopup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('hotel-name');
        var address = button.data('hotel-address');
        var phone = button.data('hotel-phone');
        var email = button.data('hotel-email');

        var modal = $(this);

        modal.find('.modal-body #hotel-name').text(name);
        modal.find('.modal-body #hotel-address').text(address);
        modal.find('.modal-body #hotel-phone').text(phone);
        modal.find('.modal-body #hotel-email').text(email);
    });

    var accomodation = document.getElementById('dropAccomodations');
    var connectButton=document.getElementById('connectButton');

    selectTrip.addEventListener('change',function(){
        document.getElementById("travelChanged").submit();
    });


    var iTripId=<?php echo $aTripData['trip_id'] ?>;
    var tripId=iTripId.trip_id
    selectTrip.value=tripId;
    connectButton.textContent="Hotel toevoegen aan "+selectTrip.options[selectTrip.selectedIndex].text+" reis";

    function connectHotelToTrip() {
        var hiddenHotelField=document.getElementById('hiddenHotelId')
        hiddenHotelField.value=accomodation.options[accomodation.selectedIndex].value;
    }
    function ConfirmDelete(){
        return confirm('Bent u zeker? \nDe reizigers die al een plaats in het hotel gekozen hebben moeten hierna een andere plaats kiezen.');
    }
</script>
@endsection
