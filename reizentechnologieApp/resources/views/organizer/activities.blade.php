@extends('layouts.app')

@section('styles')
    <style>


        h2 {
            font-size: 18px ;
        }

        p {
            font-size: 16px;
        }

        #buttonBack, #buttonSave{
            float: right;
        }

        #links, #rechts {
            margin-top: 20px;
            margin-bottom: 20px;
            padding-top: 20px;
            background-color : #AAAAAA;
            min-height: 700px;
            max-height: 700px;
            overflow-y: scroll;
            border-radius: 3px;
        }

        #links {
            width: 49%;
            float: left;

        }

        #rechts {
            width: 49%;
            float: right;
        }

        .card {
            background-color: #fff;
            margin: 7px;
            border-radius: 5px;

            box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.2);
        }

        .card:hover {
            cursor: pointer;
        }

        .card-header {
            padding: 5px 0 0 5px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 10px 0 10px 5px;
        }

        .fa-trash {
            margin-right: 10px;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.css'>
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

    <button type="button" style="width:170px; margin-left: 15px;margin-top: 10px" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal" onclick="openModalAdd()">Activity toevoegen</button>
    <button class="btn btn-primary" id="buttonSave" onclick="saveActivities()">Opslaan</button>
    <a class="btn btn-default" id="buttonBack" href="{{route("dayplanning")}}">Terug</a>

    <div id="container"></div>


    {{--    modal toevoegen--}}
    <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addActivityModalLabel">Activiteit toevoegen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {{ Form::open(array('action' => 'Organiser\ActivityController@createActivity', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('activity-name','Naam:')}}
                        {{Form::text('activity-name', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-start','start uur:')}}
                        {{Form::time('activity-start', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-end','eind uur:')}}
                        {{Form::time('activity-end', null, array( 'class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-location','Locatie:')}}
                        {{Form::text('activity-location', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-description','Beschrijving:')}}
                        {{Form::textarea('activity-description', null, array('class' => 'form-control', 'required'))}}
                    </div>

                    {{ Form::hidden('activity-id','activity-id',array('id'=>'activity-id')) }}
                    {{ Form::hidden('day-id',Request::route('dayId'),array('id'=> 'day_id')) }}
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                    {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>

    {{--    modal wijzigen--}}
    <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editActivityModalLabel">Activiteit editeren</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {{ Form::open(array('action' => 'Organiser\ActivityController@updateActivity', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('activity-name','Naam:')}}
                        {{Form::text('activity-name', null, array('class' => 'form-control', 'required'))}}
                    </div>
{{--                    <div class="form-group">--}}
{{--                        {{Form::label('activity-start','start uur:')}}--}}
{{--                        {{Form::time('activity-start', null, array('class' => 'form-control', 'required'))}}--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        {{Form::label('activity-end','eind uur:')}}--}}
{{--                        {{Form::time('activity-end', null, array( 'class' => 'form-control', 'required'))}}--}}
{{--                    </div>--}}
                    <div class="form-group" >
                        {{Form::label('activity-start','start uur:', ['style' => 'float:left; padding-right:20px'])}}
                        {{Form::text('activity-start', null, array('style' => 'width: 150px; float:left', 'class' => 'form-control', 'required'))}}

                        {{Form::label('activity-end','eind uur:', ['style' => 'padding-left:20px'])}}
                        {{Form::text('activity-end', null, array('style' => 'width: 150px; float:right;', 'class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-location','Locatie:')}}
                        {{Form::text('activity-location', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-description','Beschrijving:')}}
                        {{Form::textarea('activity-description', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    {{ Form::hidden('activity-id','activity-id',array('id'=>'activity-id')) }}
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                    {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
                    {{ Form::close() }}

                    <form method="POST" id="#deleteActivity" action="" onsubmit="return confirm('Bent U zeker? Alle gegevens worden verwijderd')">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Verwijderen"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        function ConfirmDelete(){
            return confirm('Bent u zeker? \n Als u de activiteit verwijderd, zal alle info verloren gaan!');
        }

        function openModalAdd() {
            $('#addActivityModal').modal('show')
        }

        function openModalDelete() {
            $('#deleteActivityModal').modal('show')
        }

        function openModalEdit() {
            $('#editActivityModal').modal('show')
        }

        function saveActivities(){
            var cardsRight = document.getElementById("rechts").getElementsByTagName("button");

            var route = "{{route('saveActivities', [':dayId', ':activityIds'])}}";
            route = route.replace(':dayId', "{{Request::route('dayId')}}");

            var activityIds = [];
            for (i = 0; i < cardsRight.length; i++){
               activityIds.push(cardsRight[i].dataset.activityId);

            }

            if (activityIds.length != 0){
                route = route.replace(':activityIds', activityIds);
            }else {
                route = route.replace(':activityIds', 0);
            }

            window.location.href= route;


        }

        $('#editActivityModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var activityId = button.data('activity-id');
            var activityName = button.data('activity-name');
            var activitydescription = button.data('activity-description');
            var activitylocation = button.data('activity-location');
            var activitystarthour = button.data('activity-start');
            var activityendhour = button.data('activity-end');

            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body #activity-id').val(activityId);
            modal.find('.modal-body #activity-name').val(activityName);
            modal.find('.modal-body #activity-description').val(activitydescription);
            modal.find('.modal-body #activity-location').val(activitylocation);
            modal.find('.modal-body #activity-start').val(activitystarthour);
            modal.find('.modal-body #activity-end').val(activityendhour);

            var route = "{{route('deleteActivity', ':id')}}";
            route = route.replace(':id', activityId);
            document.getElementById('#deleteActivity').action = route ;


        })
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.2/dragula.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.1/highcharts.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        class App extends React.Component {
            componentDidMount() {
                let left = document.getElementById('links');
                let right = document.getElementById('rechts');
                dragula([left, right]);

            }

            render() {
                return (
                    React.createElement("div", { className: "container" },
                        React.createElement("div", { id: "links", className: "container" },
                            @foreach($activities as $oActivity)
                            React.createElement(Card, { h3: "{{$oActivity->name}}" , body: "{{$oActivity->location}}",
                                activityId: "{{$oActivity->activity_id}}",
                                activityName:"{{$oActivity->name}}",
                                activityDescription: "{{$oActivity->description}}",
                                activityLocation: "{{$oActivity->location}}",
                                @foreach($plannings as $oPlanning)
                                    @if($oActivity->activity_id == $oPlanning->activity_id)
                                        activityStartHour:"{{$oPlanning->start_hour}}",
                                        activityEndHour: "{{$oPlanning->end_hour}}",
                                        timeBegin: "{{$oPlanning->start_hour}}",
                                        timeEnding: "{{$oPlanning->end_hour}}"
                                    @endif
                                @endforeach
                            },),


                            @endForeach
                            //
                        ),


                        React.createElement("div", { id: "rechts", className: "container" },

                            @foreach($dayActivities as $dayActivity)
                                @foreach($activities as $oActivity)
                                    @if($dayActivity->activity_id == $oActivity->activity_id)
                                        React.createElement(Card, { h3: "{{$oActivity->name}}" , body: "{{$oActivity->location}}",
                                            activityId: "{{$oActivity->activity_id}}",
                                            activityName:"{{$oActivity->name}}",
                                            activityDescription: "{{$oActivity->description}}",
                                            activityLocation: "{{$oActivity->location}}",
                                            @foreach($plannings as $oPlanning)
                                                @if($oActivity->activity_id == $oPlanning->activity_id)
                                                    activityStartHour:"{{$oPlanning->start_hour}}",
                                                    activityEndHour: "{{$oPlanning->end_hour}}",
                                                    timeBegin: "{{$oPlanning->start_hour}}",
                                                    timeEnding: "{{$oPlanning->end_hour}}"
                                                @endif
                                            @endforeach
                                        },),
                                    @endif
                                @endforeach
                            @endforeach
                            //
                        )));
            }}


        class Card extends React.Component {
            constructor(props) {
                super(props);
            }


            render() {
                return (
                    React.createElement("div", { className: "card" },
                        React.createElement("div", { className: "card-header" },
                            React.createElement("h2",{id: "activityHeader"},this.props.h3,
                                React.createElement("button", {type: "button", className: "avtivityButton fas fa-edit float-right btn btn-primary",
                                    'data-toggle': "modal", 'data-target': "#editActivityModal",
                                    'data-activity-id': this.props.activityId,
                                    'data-activity-name': this.props.activityName,
                                    'data-activity-description': this.props.activityDescription,
                                    'data-activity-location': this.props.activityLocation,
                                    'data-activity-start': this.props.activityStartHour,
                                    'data-activity-end': this.props.activityEndHour,
                                })),

                        ),


                        React.createElement("div", { className: "card-body" },
                            React.createElement("p", null, this.props.body),
                            React.createElement("b", null, 'begin:'),
                            React.createElement("input",{id:'begin', type: 'time', value: this.props.timeBegin} ),
                            React.createElement("b", null, 'eind:'),
                            React.createElement("input",{id:'eind', type: 'time', value: this.props.timeEnding} ))));
            }}


        React.render(React.createElement(App, null), document.getElementById('container'));
    </script>

@endsection
