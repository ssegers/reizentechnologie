@extends('layouts.app')

@section('styles')
<style>

.container{
    text-align: center;
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
                    <a href="dayplanning/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
                <h1>Dayplannings {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-start">
            <div class="d-flex align-items-end">
                <div class="form-group ml-md-4">
                    <button type="button" class="btn btn-primary badge-custom" data-toggle="modal" data-target="#dayplanningPopup">Nieuwe dayplanning</button>  
                </div>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 400px);">
            

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Highlight</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th colspan="1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dayplanningsPerTrip as $oDayplanning)
                        <tr>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dayplanninginfoPopup" data-day="{{$oDayplanning}}"><i class="fas fa-info-circle"></i></button></td>
                            <td><?php echo $oDayplanning->date; ?></td>
                            <td><?php echo $oDayplanning->highlight; ?></td>
                            <td><?php echo $oDayplanning->location; ?></td>
                            <td><?php echo $oDayplanning->description; ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dayplanningeditPopup" data-day='{{$oDayplanning}}'><i class="fas fa-edit"></i>edit</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--    modals-->
    <div class="modal fade" id="dayplanningPopup" tabindex="-1" role="dialog" aria-labelledby="dayPlanningPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="dayPlanningPopupLabel">Day Toevoegen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\DayPlanningController@createDayPlanning', 'method' => 'post', 'files' => true)) }}
                {!! Form::hidden('Destination', $oCurrentTrip->name) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Highlight','highlight van de dag:')}}
                        {{Form::text('Highlight', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Description','descriptie van de dag')}}
                        {{Form::text('Description', null,  array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Date','Date:')}}
                        {{Form::text('Date', null, array('class' => 'form-control','required' => 'required')) }}
                        {{Form::label('Location','locatie van de dag:')}}
                        {{Form::text('Location', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::hidden('Trip_id', $oCurrentTrip->trip_id)}}
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

    <div class="modal fade" id="dayplanninginfoPopup" tabindex="-1" role="dialog" aria-labelledby="dayplanninginfoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="dayplanninginfoLabel">Day Info</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\DayPlanningController@deleteDayPlanning', 'method' => 'post', 'files' => true)) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('HighlightView','Highlight:')}}
                        {{Form::label("", "", array('id' => 'HighlightView'))}}
                        <br>
                        {{Form::label('Description','Description:')}}
                        {{Form::label("", "", array('id' => 'DescriptionView'))}}
                        <br>
                        {{Form::label('Date','Date:')}}
                        {{Form::label("", "", array('id' => 'DateView'))}}
                        <br>
                        {{Form::label('Location','Location:')}}
                        {{Form::label("", "", array('id' => 'LocationView'))}}
                        {{Form::hidden('Trip_id')}}
                        {{Form::hidden('Day_id')}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                    {{Form::button('Verwijderen',array('class' => 'btn btn-primary', 'type' => 'delete'))}}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="dayplanningeditPopup" tabindex="-1" role="dialog" aria-labelledby="dayPlanningeditPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="dayPlanningeditPopupLabel">Day Aanpassen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Organiser\DayPlanningController@updateDayPlanning', 'method' => 'post', 'files' => true)) }}
                {!! Form::hidden('Destination', $oCurrentTrip->name) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Highlight','highlight van de dag:')}}
                        {{Form::text('Highlight', "", array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Description','descriptie van de dag')}}
                        {{Form::text('Description', "",  array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Date','Date:')}}
                        {{Form::text('Date', "", array('class' => 'form-control','required' => 'required')) }}
                        {{Form::label('Location','locatie van de dag:')}}
                        {{Form::text('Location', "", array('class' => 'form-control','required' => 'required'))}}
                        {{Form::hidden('Trip_id', "", array('required' => 'required'))}}
                        {{Form::hidden('Day_id', "", array('required' => 'required'))}}
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
    <!--    endmodals-->
</div>
@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    function ConfirmDelete(){
        return confirm('Bent u zeker? \n Als u de dag verwijderd, zal alle info verloren gaan!');
    }

    $('#dayplanningeditPopup').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var data = button.data('day');

        var modal = $(this);
        modal.find('#Highlight').val(data.highlight);
        modal.find('#Description').val(data.description);
        modal.find('#Date').val(data.date);
        modal.find('#Location').val(data.location);
        //laravel maakt voor deze geen html id aan, object wordt verkregen via het name attribute
        modal.find('[name="Trip_id"]').val(data.trip_id);
        modal.find('[name="Day_id"]').val(data.day_id);
    });

    $('#dayplanninginfoPopup').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var data = button.data('day');
        console.log(data);

        var modal = $(this);
        modal.find('#HighlightView').text(data.highlight);
        modal.find('#DescriptionView').text(data.description);
        modal.find('#DateView').text(data.date);
        modal.find('#LocationView').text(data.location);
        //laravel maakt voor deze geen html id aan, object wordt verkregen via het name attribute
        modal.find('[name="Trip_id"]').val(data.trip_id);
        modal.find('[name="Day_id"]').val(data.day_id);
    });
</script>
@endsection
