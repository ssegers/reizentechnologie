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
                <button type="button" class="btn btn-primary badge-custom" data-toggle="modal" data-target="#hotelPopup">Nieuwe accomodatie</button>
                <a href="" class="btn btn-primary badge-custom">Export to Excel</a>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-start">

            <div class="d-flex align-items-end"> 
                    
                <div class="form-group ml-md-4 ">
                    {{ Form::label('Accomodation','Verblijfsaccomodaties '.$oCurrentTrip->name.'*')}}
                    {{ Form::select('Accomodation', $aAccomodations->pluck('hotel_name','hotel_id'), '' ,['required','id'=>'dropAccomodations', 'placeholder' => 'Selecteer een accomodatie', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="d-flex align-items-end"> 
                <div class="form-group ml-md-4">
                    {{ Form::submit('Voeg toe aan reis',['class' => 'btn btn-primary form-control','onclick' => "connectHotelToTrip()"]) }}
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
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hotelinfoPopup" data-accomodation="{{$oAccomodation}}"><i class="fas fa-info-circle"></i></button></td>
                            <td>{{ $oAccomodation->hotel_name }}</td>
                            <td><?php echo $dd = date("d-m-Y", strtotime($oAccomodation->pivot->start_date)); ?></td>
                            <td><?php echo $dd = date("d-m-Y", strtotime($oAccomodation->pivot->end_date)); ?></td>
                            <td style="width:1%; white-space:nowrap;">
                                {{--{{ Form::open(array('action' => '/listrooms/'.$oAccomodation->pivot->id, 'method' => 'post')) }}--}}
                                <form method="POST" action="/hotel/listrooms/{{$oAccomodation->pivot->id}}/{{$oAccomodation->hotel_name}}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                {{ Form::submit('Bekijk kamers',array('class'=>"btn btn-primary")) }}
                                </form>
                            </td>
                            <td style="width:1%; white-space:nowrap;">
                                {{ Form::open(array('action' => 'Organiser\Accomodation@deleteHotel', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                                {{ Form::hidden('hotel_trip_id', $oAccomodation->pivot->id) }}
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
                {{ Form::open(array('action' => 'Organiser\Accomodation@createAccomodation', 'method' => 'post', 'files' => true)) }}
                {!! Form::hidden('Destination', $oCurrentTrip->name) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('AccomodationName','naam van de accomodatie:')}}
                        {{Form::text('AccomodationName', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('TypeOfAccomodation','type Accomodatie')}}
                        {{Form::select('TypeOfAccomodation', array('hotel' => 'hotel', 'jeugdherberg' => 'jeugdherberg'),'', array('required','id'=>'dropTypeOfAccomodations', 'placeholder' => 'Selecteer type accomodatie', 'class' => 'form-control' ))}}
                        {{Form::label('Address','Adres:')}}
                        {{Form::text('Address', null, array('class' => 'form-control','required' => 'required')) }}
                        {{Form::label('WebsiteAccomodation','website Hotel:')}}
                        {{Form::url('WebsiteAccomodation', null, array('class' => 'form-control'))}}
                        {{Form::label('EmailAccomodation','Email Hotel:')}}
                        {{Form::email('EmailAccomodation', null, array('class' => 'form-control'))}}
                        {{Form::label('Phone','Telnr:')}}
                        {{Form::tel('Phone', null, array('class' => 'form-control'))}}
                        {{Form::label('AccomodationImages',"Foto's van de accomodatie") }}
                        <div class="input-group">
                            <a id="lfm1" data-input="thumbnail1" class="btn btn-primary">
                               <i class="far fa-file-image"></i> foto 1
                            </a>                            
                            {{Form::text('AccomodationImage1', null, array('class' => 'form-control','id'=>'thumbnail1'))}}
                        </div>
                        <br>
                        <div class="input-group" id="AccomodationsImages2">                       
                            <a id="lfm2" data-input="thumbnail2" class="btn btn-primary">
                               <i class="far fa-file-image"></i> foto 2
                            </a>                            
                            {{Form::text('AccomodationImage2', null, array('class' => 'form-control','id'=>'thumbnail2'))}}
                        </div> 
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

    <div class="modal fade" id="hotelEditPopup" tabindex="-1" role="dialog" aria-labelledby="hotelPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelEditPopupLabel">Gegevens Aanpassen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\Accomodation@createAccomodation', 'method' => 'post', 'files' => true)) }}
                {!! Form::hidden('Destination', $oCurrentTrip->name) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('AccomodationName','naam van de accomodatie:')}}
                        {{Form::text('AccomodationName', null, array('id'=>'Ename','class' => 'form-control','required' => 'required'))}}
                        {{Form::label('TypeOfAccomodation','type Accomodatie')}}
                        {{Form::select('TypeOfAccomodation', array('hotel' => 'hotel', 'jeugdherberg' => 'jeugdherberg'),'', array('required','id'=>'Etype', 'placeholder' => 'Selecteer type accomodatie', 'class' => 'form-control' ))}}
                        {{Form::label('Address','Adres:')}}
                        {{Form::text('Address', null, array('id'=>'Eaddress','class' => 'form-control','required' => 'required')) }}
                        {{Form::label('WebsiteAccomodation','website Hotel:')}}
                        {{Form::url('WebsiteAccomodation', null, array('id'=>'Ewebsite','class' => 'form-control'))}}
                        {{Form::label('EmailAccomodation','Email Hotel:')}}
                        {{Form::email('EmailAccomodation', null, array('id'=>'Eemail','class' => 'form-control'))}}
                        {{Form::label('Phone','Telnr:')}}
                        {{Form::tel('Phone', null, array('id'=>'Ephone','class' => 'form-control'))}}
                        {{Form::label('AccomodationImages',"Foto's van de accomodatie") }}
                        <div class="input-group">
                            <a id="lfm1" data-input="Epicture1" class="btn btn-primary">
                               <i class="far fa-file-image"></i> foto 1
                            </a>                            
                            {{Form::text('AccomodationImage1', null, array('class' => 'form-control','id'=>'Epicture1'))}}
                        </div>
                        <br>
                        <div class="input-group" id="AccomodationsImages2">                       
                            <a id="lfm2" data-input="Epicture2" class="btn btn-primary">
                               <i class="far fa-file-image"></i> foto 2
                            </a>                            
                            {{Form::text('AccomodationImage2', null, array('class' => 'form-control','id'=>'Epicture2'))}}
                        </div> 
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
    
    <div class="modal fade" id="connectToTripPopup" tabindex="-1" role="dialog" aria-labelledby="hoteltripPopupLabel">
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
                        <tr><td><p id="picture1"></p></td><td><p id="picture2"></p></td></tr>
                        <tr><td>Naam:</td><td><p id="name" > </p></td></tr>
                        <tr><td>Type verblijf:</td><td><p id="type"></p></td></tr>
                        <tr><td>website:</td><td><p id="website"></p></td></tr>
                        <tr><td>Adres:</td><td><p id="address"></p></td></tr>
                        <tr><td>Telnr:</td><td><p id="phone"></p></td></tr>
                        <tr><td>Emailadres:</td><td><p id="email"></p></td></tr>
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
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript">
        var domain = "";
        $('#lfm1').filemanager('image',{prefix: domain});
        $('#lfm2').filemanager('image',{prefix: domain});
        </script>
<script>
    var accomodation = document.getElementById('dropAccomodations');
    function edit(){
        if(accomodation.options[accomodation.selectedIndex].value === '') {
            window.alert('je moet een accomodatie selecteren om te editeren');
        }else{
            $('#hotelEditPopup').modal("show");
        }
        
        $('#hotelEditPopup').on('show.bs.modal', function (event) {
            var accomodations = <?php echo(json_encode($aAccomodations)) ?>;
            var selectedAccomodation = accomodations[accomodation.options[accomodation.selectedIndex].value];
            var modal = $(this);

            document.getElementById("Ename").value = selectedAccomodation["hotel_name"];
            var dd = document.getElementById('Etype');
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].text === selectedAccomodation["type_of_accomodation"]) {
                    dd.selectedIndex = i;
                    break;
                }
            }

            document.getElementById("Eaddress").value = selectedAccomodation["address"];
            document.getElementById("Ewebsite").value = selectedAccomodation["website_link"];
            document.getElementById("Ephone").value = selectedAccomodation["phone"];
            document.getElementById("Eemail").value = selectedAccomodation["email"];
            document.getElementById("Epicture1").value = selectedAccomodation["picture1_link"];
            document.getElementById("Epicture2").value = selectedAccomodation["picture2_link"];
        });
    }
   
    $('#hotelinfoPopup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var accomodation = button.data('accomodation');
        var modal = $(this);

        document.getElementById("picture1").innerHTML = '<img src="'+accomodation["picture1_link"]+'" alt="foto 1" class="img-fluid">';
        document.getElementById("picture2").innerHTML = '<img src="'+accomodation["picture2_link"]+'" alt="foto 2" class="img-fluid">';
        modal.find('.modal-body #name').text(accomodation["hotel_name"]);
        document.getElementById("type").innerHTML = accomodation["type_of_accomodation"];
        document.getElementById("website").innerHTML = '<a href ="'+accomodation["website_link"]+'" target="_blank">hotel website</a>';
        modal.find('.modal-body #address').text(accomodation["address"]);
        modal.find('.modal-body #phone').text(accomodation["phone"]);
        modal.find('.modal-body #email').text(accomodation["email"]);
    });



    function connectHotelToTrip() {
        if(accomodation.options[accomodation.selectedIndex].value === '') {
            window.alert('je moet eerst een accomodatie selecteren');
        }else{
            var hiddenHotelField = document.getElementById('hiddenHotelId');
            hiddenHotelField.value=accomodation.options[accomodation.selectedIndex].value;
            $('#connectToTripPopup').modal("show");
        }
        
       
    }
    function ConfirmDelete(){
        return confirm('Bent u zeker? \nDe reizigers die al een plaats in het hotel gekozen hebben moeten hierna een andere plaats kiezen.');
    }
</script>
@endsection
