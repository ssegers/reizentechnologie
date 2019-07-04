<div>
    <p><b>Beste {{ $name }}, </b></p>
    <p>Je hebt via de site reizen technologie een aanvraag gedaan om je paswoord opnieuw in te stellen.</p>
    <p>je kan je passwoord aanpassen door <a href="<?php echo "http://" . $_SERVER["SERVER_NAME"] . "/password/resetpassword/"; ?>{{$token}}">hier </a>te klikken</p>
    <p>Let op deze mail is maar 30 minuten geldig</p>
</div>