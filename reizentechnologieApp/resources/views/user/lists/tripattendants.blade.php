@extends('layouts.app')

@section('styles')
<style>
    body, html {
  margin: 0;
  overflow-x: hidden;
  overflow-y: hidden;
  height:100vh;
 
}
</style>
@endsection

@section('content')
    {{Form::open(array('url' => "organiser/partisipantslist/$oCurrentTrip->trip_id", 'method' => 'post'))}}
    
    <div class="flex-container">
    <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 200px);">
        <div class="d-flex flex-column col-auto overflow-auto" id="left">
            <div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="button-filter" value="button-filter" class="btn btn-primary">Selectie toepassen</button>          
                </div>
                <div class="form-group">                   
                    @foreach($aFilterList as $sFilterName => $sFilterText)
                    <div class="d-flex justify-content-between">                       
                        <div>{{ $sFilterText }}</div>
                        <div>
                            @if(array_key_exists($sFilterName, $aFiltersChecked))
                                {{ Form::checkbox($sFilterName, null, true) }}
                            @else
                                {{ Form::checkbox($sFilterName, null, false) }}
                            @endif
                        </div>
                    </div>
                    @endForeach
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-grow-1 overflow-auto" id="main">
            <div class="d-flex flex-row">
                @foreach($aTripsAndNumberOfAttendants as $aTripData)
                    @if($aTripsByOrganiser->contains('trip_id',$aTripData['trip_id']))
                        <a href="/organiser/partisipantslist/{{ $aTripData['trip_id'] }}" class="btn btn-success badge-custom">
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
                    <h1>Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="export" value="pdf">PDF</button>
                    <button class="btn btn-primary" type="submit" name="export" value="excel">Excel</button>
                </div>
            </div>

            <div class="d-flex flex-row">
                       
                <div class="table-responsive" >
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                        <tr>
                            @foreach($aFiltersChecked as $sFilterValue)
                                <th>{{ $sFilterValue }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aUserData as $oUserData)
                            <tr class="cursor-pointer" onclick="displayUser('<?php echo $oUserData->username ?>')">
                                @foreach($aFiltersChecked as $sFilterName => $sFilterText)
                                    <td>{{ $oUserData->$sFilterName }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>    
            <div class="d-flex flex-row justify-content-between">
                <div>
                    {{ $aUserData->appends(request()->input())->links() }}
                </div>
                <div>
                    {{ Form::label('per-page', 'Reizigers per pagina:') }}
                    <select name="per-page" onchange="this.form.submit()">
                        @foreach($aPaginate as $iValue => $bActive)
                            @if($bActive)
                                <option selected value="{{ $iValue }}">{{ $iValue }}</option>
                            @else
                                <option value="{{ $iValue }}">{{ $iValue }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>  
    </div>
</div>
{{ Form::close() }}
@endsection
@section('scripts')
<script type="text/javascript">
//    function displayUser(userName) {
//        window.location.href = '<?php echo url('/') ?>/userinfo/' + userName;
//    }
</script>
@endsection