$(document).ready(function () {
    $('#add-zip-button').click(function(){
        var zip_code = $('#zip-text').val();
        var city = $('#city-text').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "step-add-zip",
            data: {
                city: city,
                zip_code: zip_code,
            },
            success:function (result) {
                    $('#error').hide();
                    $('#dropGemeentes')
                    .append($("<option></option>")
                    .attr("data-tokens",result['zip_code']+' '+result['city'])
                    .attr("value",result["zip_id"])
                    .text(result['zip_code']+' '+result['city'])); 
           
                    $('#dropGemeentes').val(result["zip_id"]);
                    $('.filter-option-inner-inner').html(result["zip_code"]+ " "+result["city"]);
            },
            error: function (request, status, error) {
                $('#error').show();
                json = $.parseJSON(request.responseText);
                $.each(json.errors, function(key, value){   
                    $('#error').html('<p>'+value+'</p>');
                });
            }
        });
    });
});