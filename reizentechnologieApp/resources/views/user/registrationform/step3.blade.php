@extends('layouts.app')

@section('content')

<div class="container bg-white rounded shadow-sm">
    <h2 class="my-2 pb-2 border-bottom border-dark">Contact gegevens</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    {{ Form::open(array('action' => 'Auth\RegisterController@step3', 'method' => 'post')) }}
    <div class="form-row">
        <div class="form-group col-md-8">
            {{ Form::label('E-mail adres*') }}
            <div class="input-group">           
                {{ Form::text('txtEmailLocalPart', $sEnteredEmailLocalPart, ['required','id'=>'txtEmailLocalPart','class' => 'mb-2 form-control ', 'placeholder' => 'email'])}}
                <div class="input-group-append">
                    <span class="form-control">@</span>
                </div>
                @if($sEmailDomain == 'student.ucll.be' || $sEmailDomain == 'ucll.be')
                    {{ Form::text('txtEmailDomain', $sEmailDomain, ['required', 'class' => 'form-control', 'readonly']) }}
                @else
                    {{ Form::text('txtEmailDomain', $sEmailDomain, ['required', 'class' => 'form-control','placeholder' => 'domain.be']) }}
                @endif
            </div>
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('txtGsm','GSM-nummer*') }}
            {{ Form::text('txtGsm', $sEnteredMobile, ['required', 'id'=>'txtGsm', 'class' => 'mb-2 form-control '])}}
        </div>
    </div>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-6">
            {{ Form::label('txtNoodnummer1','Noodnummer 1*') }}
            {{ Form::text('txtNoodnummer1', $sEnteredEmergency1, ['required', 'id'=>'txtNoodnummer1', 'class' => 'mb-2 form-control '])}}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('txtNoodnummer2','Noodnummer 2') }}
            {{ Form::text('txtNoodnummer2', $sEnteredEmergency2, ['id'=>'txtNoodnummer2', 'class' => 'mb-2 form-control '])}}
        </div>
    </div>
    <h2 class="my-2 pb-2 border-bottom border-dark">Medische gegevens</h2>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-12">
        {{ Form::label('radioMedisch','Zijn er medische gegevens die belangrijk zijn voor de begeleiders? (Allergie, ziekte, medicatie, ...)') }}

        <div>
            {{ Form::radio('radioMedisch', '1', $bCheckedMedicalCondition,['id'=>'radioMedisch'])}}
            Ja
            {{ Form::radio('radioMedisch', '0', !$bCheckedMedicalCondition, ['id'=>'radioMedisch'])}}
            Nee
        </div>
        </div>
    </div>
    <div class="form-row pt-2">
        <div class="form-group col-md-12">
            {{ Form::label('txtMedisch','Indien ja, noteer dan hier de gegevens') }}
            {{ Form::textarea('txtMedisch', $sEnteredMedicalCondition, ['id'=>'txtMedisch','width' => '100%','placeholder'=>'gegevens','class' => 'mb-2 form-control '])}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 float-right">
             <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/registrationform/step-2">Vorige</a>
             {{ Form::submit('Registreer',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
<script type="text/javascript">
    var radio = document.getElementsByName("radioMedisch");
    for(var i =0; i<radio.length; i++){
        radio[i].addEventListener('change', function(){

            var radio = document.getElementsByName("radioMedisch");
            var value = null;
            for(var i = 0; i< radio.length; i++){
                if(radio[i].checked){
                    value= radio[i].value;
                }
            }

            if(value == 0){
                if (confirm("Hierbij wordt uw opgeslagen medische info verwijdert, bent u zeker dat u wil doorgaan?"))  {
                    var medic = document.getElementById("txtMedisch");
                    medic.disabled = true;
                    medic.value = null;
                }
                else {
                    document.getElementsByName("radioMedisch").value=0;
                }
            }

            LaatTextAreaZien();
        })
    }

    function LaatTextAreaZien(){
        var radio = document.getElementsByName("radioMedisch");
        var value = null;
        for(var i = 0; i< radio.length; i++){
            if(radio[i].checked){
                value= radio[i].value;
            }
        }
        var textarea = document.getElementById("txtMedisch");
        if(value == 0){
           textarea.disabled = true;
        }
        else{
            textarea.disabled = false;
        }
    }

    LaatTextAreaZien();

</script>


@endsection