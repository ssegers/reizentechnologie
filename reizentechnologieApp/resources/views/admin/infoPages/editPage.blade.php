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
        <h2>Pagina "{{ $oPage->name }}" aanpassen</h2>
    </div>
    <div class="form-group">
    {{ Form::open(array('url' => 'admin\updatePage', 'method' => 'post','files' => true)) }}
        <table id="inlineFormTable">
            <tr>
                <td>
                    <div class="form-inline">
                        {{Form::label('typeSelector','Type bestand:',array('style'=>'padding-right:10px'))}}
                        {{Form::select('typeSelector', array('pdf' => 'PDF', 'html' => 'HTML'),null,array('id'=>'typeSelector','class'=>'form-control'))}}
                    </div>
                </td>
                <td>
                    <div class="form-check">
                        {{Form::checkbox('Visible', 'true',null,array('class'=>'form-check-input','id'=>'Visible'))}}
                        {{Form::label('Visible','Zichtbaar',array('class'=>'form-check-label'))}}
                    </div>
                </td>
            </tr>
        </table>
        <div id="pdf1">
            <br/>
            <div class="input-group">
               <span class="input-group-btn">
                 <a id="lfm" data-input="thumbnail" data-preview="preview" class="btn btn-primary">
                   <i class="far fa-file-pdf"></i> Kies Pdf
                 </a>
               </span>
                {{--<input id="thumbnail" class="form-control" type="text" name="filepath">--}}
                {{Form::text('filepath', null, array('class' => 'form-control','id'=>'thumbnail'))}}
            </div>
        </div>
        <br/>
        <div class="actions">
            {{ Form::hidden('pageId', $oPage->page_id) }}
            {{ Form::submit('Opslaan',array('class'=>"btn btn-primary")) }}
            <input type="button" class="btn btn-primary" onclick="if(ConfirmDelete()){window.location='{{ url("admin/overviewPages") }}'}" value="Annuleren"/>
        </div>
        <br/>
        <div id="pdf2">
            <div class="embed-responsive embed-responsive-4by3">
                <embed class="embed-responsive-item" id="preview" src="" type='application/pdf'>
            </div>
        </div>

        <div id="html" class="form-group">
            {{ Form::textArea('content',"", ['class' => 'form-control','id'=>'content']) }}
        </div>

    {{ Form::close()}}
    </div>
    @endsection
    @section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        function ConfirmDelete(){
            return confirm('Are you sure? If you leave before saving, your changes will be lost.');
        }

        $( 'textarea' ).ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
            contentsCss: '{{ asset("css/app.css") }}',
            height: '200px',
            width: '98%'
        });
    </script>
    <script type="text/javascript">
        var domain = "";
        $('#lfm').filemanager('file',{prefix: domain});
        var pdf = document.getElementById('preview');
        var editor=document.getElementById('content');
        var typeSelect=document.getElementById('typeSelector');
        var visibleCheckbox=document.getElementById('Visible');
        var pdfDiv1=document.getElementById('pdf1');
        var pdfDiv2=document.getElementById('pdf2');
        var htmlDiv=document.getElementById('html');
        var filepath=document.getElementById('thumbnail');

        setTimeout(function(){
            if ($('#removeTimer').length > 0) {
                $('#removeTimer').remove();
            }
        }, 5000);

        typeSelect.addEventListener("change",function (){
            switchType();
        });

        function switchType() {
            if (typeSelect.value=='html'){
                pdfDiv1.style.display="none"
                pdfDiv2.style.display="none"
                htmlDiv.style.display="block"
            }
            else {
                htmlDiv.style.display="none"
                pdfDiv1.style.display="block"
                pdfDiv2.style.display="block"
            }
        }
        function switchPage(){
          var page=<?php echo $oPage ?>;
            typeSelect.value=page.type;
            if(page.type=='pdf'){
                pdf.src = page.content;
                filepath.value=page.content;
                CKEDITOR.instances["content"].setData("");
                }
            else {
                CKEDITOR.instances["content"].setData(page.content);
                pdf.src = "";
                filepath.value="";
            }
            if (page.is_visible==true){
                visibleCheckbox.checked=true;
            }
            else {
                visibleCheckbox.checked=false;
            }
            switchType();
        };
        switchPage();
        switchType();
    </script>
@endsection