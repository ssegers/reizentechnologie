<!doctype html>
<html>
    <head>
        
    </head>
    <body>
        <div>
            <p>Opmerkingen of vragen over deze mail? Mail naar {{$aData["contactMail"]}} </p>
            <hr>
            <p style="text-align:center;"><img alt="" src="http://reizentechnologie.local/storage/photos/shares/header1.jpg" style="height:100px; width:873px" /></p>
            <h2 style="text-align: center;"><b>Er is nieuws met betrekking tot de {{$aData['trip']->name}} {{$aData['trip']->year}} reis:</b></h2>
            <hr>
        </div>

        <div>

          {!! $aData['message'] !!}  
    
        </div>

        <div>
            <hr>            
        </div>
    </body>
</html>
