@extends('layouts.app')
@section('styles')
<style>
    .carousel-inner > .item > img, .carousel-inner > .item > a > img{
    margin:auto;
}
   </style>
@endsection
@section('content')
<div class="container">
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