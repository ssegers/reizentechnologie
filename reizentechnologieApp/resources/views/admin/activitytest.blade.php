@section('activityStyles')

    <style>
        html, body {
            font-family: Lato, Arial, sans-serif;
        }

        h3 {
            font-size: 18px !important;
        }

        p {
            font-size: 16px;
        }
        #links, #rechts {
            margin-top: 20px;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.css'>
@endsection
@section('activityContent')

    <div class="modal fade bd-example-modal-lg" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Activities bewerken </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <button type="button" style="width:170px; margin-left: 15px;margin-top: 10px" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal" onclick="openModalAdd()">Activity toevoegen</button>
                <div id="container"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleer</button>
                    <button type="button" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </div>
    </div>

    {{--    modal toevoegen--}}
    <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nieuwe activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Titel</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">beschrijving</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="button" class="btn btn-primary">Voeg toe</button>
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
                {{ Form::open(array('action' => 'Organiser\DayPlanningController@updateOrCreateActivity', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('activity-name','Naam:')}}
                        {{Form::text('activity-name', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-description','Beschrijving:')}}
                        {{Form::text('activity-description', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    <div class="form-group">
                        {{Form::label('activity-location','Locatie:')}}
                        {{Form::text('activity-location', null, array('class' => 'form-control', 'required'))}}
                    </div>
                    {{ Form::hidden('activity-id','activity-id',array('id'=>'activity-id')) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>




    {{--    modal verwijderen--}}
    <div class="modal fade" id="deleteActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Activity titel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bent u zeker dat u deze activiteit wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="button" class="btn btn-danger">Verwijderen</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('activityScripts')

    <script>

        function openModalAdd() {
            $('#addActivityModal').modal('show')
        }

        function openModalDelete() {
            $('#deleteActivityModal').modal('show')
        }

        function openModalEdit() {
            $('#editActivityModal').modal('show')
        }


        $('#editActivityModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var activityId = button.data('activity-id');
            var activityName = button.data('activity-name');
            var activitydescription = button.data('activity-description');
            var activitylocation = button.data('activity-location');

            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body #activity-id').val(activityId);
            modal.find('.modal-body #activity-name').val(activityName);
            modal.find('.modal-body #activity-description').val(activitydescription);
            modal.find('.modal-body #activity-location').val(activitylocation);

        })
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.2/dragula.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.1/highcharts.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{--    <script src="{{asset('/js/activityDragAndDrop.js')}}"></script>--}}

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
                                React.createElement(Card, { h3: "{{$oActivity->name}}" , body: "{{$oActivity->description}}",
                                activityId: "{{$oActivity->activity_id}}",
                                activityName:"{{$oActivity->name}}",
                                activityDescription: "{{$oActivity->description}}",
                                activityLocation: "{{$oActivity->location}}"}),

                            @endForeach
                        // lol
                        ),


                        React.createElement("div", { id: "rechts", className: "container" },
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
                            React.createElement("h3",null, this.props.h3,
                                React.createElement("button", {type: "button", className: "avtivityButton fas fa-edit float-right btn btn-primary",
                                'data-toggle': "modal", 'data-target': "#editActivityModal",
                                'data-activity-id': this.props.activityId,
                                'data-activity-name': this.props.activityName,
                                'data-activity-description': this.props.activityDescription,
                                'data-activity-location': this.props.activityLocation,
                            })),

                            ),


                        React.createElement("div", { className: "card-body" },
                            React.createElement("p", null, this.props.body),
                            React.createElement("b", null, 'begin:'),
                            React.createElement("input",{id:'begin', type: 'time'} ),
                            React.createElement("b", null, 'eind:'),
                            React.createElement("input",{id:'eind', type: 'time',} ))));
            }}


        React.render(React.createElement(App, null), document.getElementById('container'));
    </script>
@endsection
