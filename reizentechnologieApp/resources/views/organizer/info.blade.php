@extends('layouts.app')
@section('styles')
<style>
    .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    margin:auto;
}

textarea{
    margin-top: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;

}

h1{
    margin-top: 20px;
}

input{
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
}

.container{
    text-align: center;
}

</style>
@endsection
@section('content')
<div class="container">
<h1>Algemene info</h1>
<hr />
<form method="POST" class="htmlEditor" action="/admin/info">
    <div>
        <textarea cols="80" rows="12" id="info_content" name="info_content"> <?php echo $info_content; ?>
        </textarea>
        <input type="submit" value="Opslaan" name="action"/>
        <input type="submit" value="Annuleren" name="action"/>
    </div>
</form>
</div>
@endsection

@section('page_specific_scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>CKEDITOR.replace( 'info_content',{ height:450} ); </script>
@endsection