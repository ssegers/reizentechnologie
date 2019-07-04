<!--
 * Created by PhpStorm.
 * User: kaana
 * Date: 15/11/2018
 * Time: 9:36
 */-->
@extends('layouts.app')
@section('content')
    <br>
    <div class="container rounded bg-white">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Contactpagina:</h1>
        <p>Vragen in verband met een van de reizen voor de studenten Technologie
            van UCLL Limburg? Gebruik dan onderstaand contact formulier
        </p>
        {{ Form::open(array('url' => 'contact', 'method' =>'post')) }}
       
        <div class="form-group">
            <label for="trip">Reis: </label><br>
            {!! Form::select('trip', $activeTrips, null, ['placeholder' => 'Selecteer een reis ...', "class" => "form-control",'required']) !!}
        </div>
        <div class="form-group">
            <label for="email">Jouw E-mailadres :</label><br>
            {{Form::email('email','',array("class" => "form-control", "required" ))}}
        </div>
        <div class="form-group">
            <label for="subject">Onderwerp :</label><br>
            {{Form::text('subject','',array("class" => "form-control", "required" ))}}
        </div>
        <div class="form-group">
            <label for="message">Bericht: </label><br>
            {{ Form::textarea('message','',array("class" => "form-control", "required" )) }}<br>
        </div>

        <div class="form-group">
            <label for="captcha" class="col-md-4 control-label">Captcha:</label>
            <div class="col-md-12">
                <div class="captcha" style="display: inline-flex;">
                    <input id="captcha" autocomplete="off" autocorrect="off" type="text" class="form-control pr-2" placeholder="Vul Captcha in" name="captcha">
                    <span class="pr-2 pl-2">{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-success btn-refresh">Ververs</button>
                </div>


               
            </div>
        </div>
        <br>
        <div class="form-group">
        {{ Form::submit('Submit',array("class" => "btn btn-primary", 'onclick' => "this.disabled=true;this.form.submit();")) }}
        <input type="button" class="btn btn-danger" onclick="history.go(0)" value="Annuleren"/>
        {{ Form::close() }}
        </div>
        <br>
    </div>
    
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-refresh").click(function(){
                $.ajax({
                    type:'GET',
                    url:'refresh_captcha',
                    success:function(data){
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        });


    </script>
@endsection