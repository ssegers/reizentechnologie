@extends('layouts.app')

@section('content')
<div class="container bg-white rounded shadow-sm">
    <div id="error" class="alert alert-danger" role="alert" style="display: none;"></div>

    <h2 class="my-2 pb-2 border-bottom border-dark">Persoonlijke gegevens</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(array('action' => 'Auth\RegisterController@step2', 'method' => 'post')) }}
    {{ csrf_field() }}
    <!-- Name info -->
    <div class="form-row ">
        <div class="form-group col-md-4">
            {{ Form::label('txtNaam', 'Achternaam*') }}
            {{ Form::text('txtNaam', $sEnteredLastName, ['required','id'=>'txtNaam', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('txtVoornaam', 'Voornaam*') }}
            {{ Form::text('txtVoornaam', $sEnteredFirstName, ['required','id'=>'txtVoornaam','class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4 ">
             {{ Form::label('Gender','Geslacht*') }}
            <br/>
            @foreach($aGenderOptions as $value => $Content)
            <div class="form-check form-check-inline mt-2">
                @if($value == lcfirst($sCheckedGender))
                    {{ Form::radio('gender', $Content, true,['value'=> $value, 'class'=>'form-check-input'])}}
                @else
                    {{ Form::radio('gender', $Content, null,['value'=> $value, 'class'=>'form-check-input'])}}
                @endif
                {{ Form::label('gender', $Content, ['class'=>'form-check-label']) }}
            </div>
            @endforeach
        </div>
    </div>

    <!-- Birth info -->

    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            {{ Form::label('txtNationaliteit', 'Nationaliteit') }}
            {{ Form::text('txtNationaliteit', $sEnteredNationality, ['required', 'id'=>'txtNationaliteit','class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('dateGeboorte','Geboortedatum (JJJJ-MM-DD)*') }}
            {{ Form::text('dateGeboorte', $sEnteredBirthDate, ['required', 'id'=>'dateGeboorte', 'class' => 'mb-2 form-control','placeholder' => 'JJJJ-MM-DD' ,'pattern' =>'([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))', 'title' => 'JJJJ-MM-DD'])}}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('txtGeboorteplaats','Geboorteplaats*') }}
            {{ Form::text('txtGeboorteplaats', $sEnteredBirthPlace, ['required', 'id'=>'txtGeboorteplaats','class' => 'mb-2 form-control'])}}
        </div>
    </div>

    <!-- Adress info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            {{ Form::label('txtAdres','Adres*') }}
            {{ Form::text('txtAdres', $sEnteredAddress, ['required', 'id'=>'txtAdres','class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <button type="button" id="cityButton" class="open btn-primary rounded btn-xs float-right" data-toggle="modal" data-target="#zipPopup">
                <i class="fas fa-plus-circle "></i>
            </button>
            {{ Form::label('dropGemeentes','Woonplaats*') }}
            <select id="dropGemeentes" name="dropGemeentes" data-live-search="true" required class="mb-2 form-control selectpicker">
                <option value="0" disabled selected>Selecteer een woonplaats</option>
                @foreach($aCities as $oCity)
                <option data-tokens="{{ $oCity->zip_code }} {{ $oCity->city }}" value="{{ $oCity->zip_id }}"> {{ $oCity->zip_code }} {{ $oCity->city }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label class="form-label">Land*</label>
            {{ Form::text('txtLand', $sEnteredCountry, ['required', 'id'=>'txtLand','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <!-- Bank info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-6">
            <label class="form-label">Bankrekeningnummer (IBAN)*</label>
            {{ Form::text('txtBank', $sEnteredIban, ['required', 'id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34, 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Bankidentificatiecode (BIC)*</label>
            {{ Form::text('txtBic', $sEnteredBic, ['required', 'id'=>'txtBIC','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 float-right">
            <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/registrationform/step-1">Vorige</a>
            {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        </div>
    </div>

    {{ Form::close() }}

<!-- MODAL POPUP -->
    <div class="modal" id="zipPopup" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Postcode toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col">
                        {{Form::label('zip_code', 'Postcode: ', ['class' => ''])}}
                        {{ Form::number('zip_code', null, array("id"=>"zip-text","class" => "form-control", "required", "min" => "1000", "max" => "9999", "oninvalid" => "this.setCustomValidity('Deze postcode is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv. 3660" )) }}
                    </div>
                    <div class="form-group col">
                        {{Form::label('city', 'Stad of Gemeente: ', ['class' => ''])}}
                        {{ Form::text('city', null, array("id"=>"city-text","class" => "form-control", "required","maxlength" => "50", "oninvalid" => "this.setCustomValidity('Deze gemeente is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv: Opglabbeek")) }}
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="add-zip-button" type="button" class="btn btn-primary" data-dismiss="modal">Postcode Toevoegen</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')
    <script>$('#dropGemeentes').val({{ $iSelectedCityId }})</script>
    <script src="{{ URL::asset('/js/addZipForm.js') }}"></script>
@endsection