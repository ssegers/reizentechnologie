@extends('layouts.admin')

@section('content')
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
    <div class="d-flex justify-content-center">
        <h2>Beheer Info pagina's</h2>
    </div>
    <div class="d-flex p-1 text-white">
    {{Form::button('Nieuwe Pagina Aanmaken',array('class' => 'btn btn-primary', 'type' => 'button','data-toggle'=>'modal','data-target'=>'#pageModal'))}}
    </div>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Type</th>
            <th scope="col">Pagina Zichtbaar</th>
            <th scope="col">Bewerken</th>
            <th scope="col">Verwijderen</th>
        </tr>
    </thead>
    <tbody>
    @foreach($aPages as $oPage)
        <tr>
            <td>{{$oPage->name}}</td>
            <td>{{$oPage->type}}</td>
            @if($oPage->is_visible)
                <td>Zichtbaar</td>
            @else
                <td>Niet Zichtbaar</td>
            @endif
            <td>
                {{ Form::open(array('url' => 'admin\editPage', 'method' => 'post')) }}
                {{ Form::hidden('name', $oPage->name) }}
                {{ Form::submit('Edit',array('class'=>"btn btn-primary")) }}
                {{ Form::close()}}
            </td>
            <td>
                {{ Form::open(array('url' => 'admin\deletePage', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                {{ Form::hidden('pageId', $oPage->page_id) }}
                {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                {{ Form::close()}}
            </td>
        </tr>
    @endForeach
    </tbody>
</table>
    
    <div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="pageModalLabel">Pagina aanmaken</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'Admin\InfoPagesController@createPage', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Name','Pagina Naam:')}}
                        {{Form::text('Name', null, array('class' => 'form-control'))}}
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
@endsection
@section('scripts')
<script>
    setTimeout(function(){
        if ($('#removeTimer').length > 0) {
            $('#removeTimer').remove();
        }
    }, 5000);

    function ConfirmDelete(){
        return confirm('Bent U zeker?');
    }
</script>
@endsection