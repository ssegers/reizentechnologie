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
        <div class="d-flex flex-row justify-content-between">
            <div>
                <h1>Accomodaties {{ $currentTrip->name }} {{ $currentTrip->year }}</h1>
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
                            <th></th>
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
                                <a href="{{route('roomsOverviewTraveller', [$oAccomodation->pivot->id, $oAccomodation->hotel_id])}}" class="btn btn-primary badge-custom"">kamerverdeling</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modals -->
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
    <!-- endmodals -->
</div>
@endsection
@section('scripts')
<script>
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

</script>
@endsection