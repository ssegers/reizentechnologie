@extends('layouts.app')

@section('content')

<div class="container bg-white rounded shadow-sm">

    <h2 class="my-2 pb-2 border-bottom border-dark">Basisgegevens</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{ Form::open(array('action' => 'Auth\RegisterController@step1', 'method' => 'post')) }}
    {{ csrf_field() }}
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-6">
            {{ FORM::label('droprReis','Reis*')}}
            {{ Form::select('dropReis', $aTrips, $iSelectedTripId ,['required','id'=>'dropReis', 'placeholder' => 'Selecteer een reis', 'class' => 'mb-2 form-control '])}}
        </div>
        <div class="form-group col-md-6">
            {{ FORM::label('txtStudentNummer','Studentnummer*') }}
            {{ Form::text('txtStudentNummer', $sEnteredUsername, ['required','id'=>'txtStudentnummer', 'class' => ' mb-2 form-control'])}}
        </div>
    </div>
    <div class="form-row pt-2">
        <div class="form-group col-md-6">
            {{ Form::label('Study','Opleiding*') }}
            {{ Form::select('Study',  $aStudies, $iSelectedStudyId , [ 'required','id'=>'dropOpleiding', 'placeholder' => 'Selecteer een opleiding', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('Major','Afstudeerrichting*')}}
            {{ Form::select('Major', $aMajors, $iSelectedMajorId ,['required','id'=>'dropAfstudeerrichtingen', 'placeholder' => 'Selecteer eerst een opleiding', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/registrationform/step-0">Vorige</a>
    {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
    {{ Form::close() }}
</div>
@endsection

@section('scripts')
    <script src="{{ mix('js/dropdown/cascadingDropDownStudyMajors.js') }}" type="text/javascript"></script>
@endsection