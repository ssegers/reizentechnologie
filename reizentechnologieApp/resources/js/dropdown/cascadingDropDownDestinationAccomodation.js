$(document).ready(function() {

    $('select[name="Destination"]').on('change', function(){
        var destinationName = $(this).val();
        if(destinationName) {
            $.ajax({
                url: '/destination/get/'+destinationName,
                type:"GET",
                dataType:"json",

                success:function(data) {

                    $('select[name="Accomodation"]').empty();
                    $('select[name="Accomodation"]').append('<option value="">Selecteer een accomodatie</option>');
                    $.each(data, function(key, value){

                        $('select[name="Accomodation"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="Accomodation"]').empty();
            $('select[name="Accomodation"]').append('<option value="">Selecteer eerst een bestemming</option>');
        }

    });

});