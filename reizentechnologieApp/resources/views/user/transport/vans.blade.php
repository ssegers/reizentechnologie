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
    <div class="d-flex flex-column flex-grow-1 overflow-auto" id="main">

        <div class="d-flex flex-row justify-content-between">
            <div>
                <h1>Vervoer {{ $currentTrip->name }} {{ $currentTrip->year }}</h1>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-row flex-nowrap py-3 justify-content-center overflow-auto" style="height: calc(100vh - 300px);">    
        <div class="container-fluid">
        <table class="table text-center">
            <thead>
            <tr class="row">
                <th class="col-sm-3">Bestuurder</th>
                <th class="col-sm-2">Bezettingsgraad</th>
                <th class="col-sm-7">Passagiers</th>
            </tr>
            </thead>
            <tbody>    

            @foreach ($vansPerTrip as $van)
                <tr class="row">
                    @if (empty($van->driver))
                        <td class="col-sm-3">{{ 'nog geen chauffeur voorzien' }}</td>
                    @else
                         <td class="col-sm-3">{{ $van->driver->first_name." ".$van->driver->last_name }}</td>
                    @endif
                   
                    <td class="col-sm-2"><h4>{{$occupationPerVan[$van->transport_id]}}/{{$van->size}}</h4></td>
                    <td class="col-sm-7">
                        <button class=" btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$van->transport_id}}" aria-expanded="true" aria-controls="collapseExample">
                        Bekijk passagiers
                        </button>
                    </td>
                </tr>
              
                <tr class="row">
                    <td class="col-sm-3"></td>
                    <td class="col-sm-2"></td>
                    <td class="col-sm-7">
                        <div class="collapse" id="collapse{{$van->transport_id}}">
                            <div class="card card-body">
                                <table class="table text-center">
                                    <?php $i=0 ?>
                                    @foreach($travellersPerVan[$van->transport_id] as $traveller)
                                        <tr>
                                            <td>{{$traveller->first_name}} {{$traveller->last_name}}
                                                @if($traveller->traveller_id == $currentTravellerId)
                                                    {{ Form::open(array('url' => route('leaveVan',[$van->transport_id]), 'method' => 'post')) }}
                                                    {{ Form::button('Verlaat Voertuig',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                    @for($i;$i<$van->size;$i++)
                                        {{ Form::open(array('url' => route('selectVan',[$van->transport_id]), 'method' => 'post')) }}
                                         <tr>
                                             <td>
                                                 {{Form::button('Kies Auto',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                             </td>
                                         </tr>
                                        {{Form::close()}}
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>     
@endsection