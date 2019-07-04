$(document).ready(function() {

    $('select[name="Study"]').on('change', function(){
        var studyId = $(this).val();
        if(studyId) {
            $.ajax({
                url: '/majors/get/'+studyId,
                type:"GET",
                dataType:"json",

                success:function(data) {

                    $('select[name="Major"]').empty();
                    $('select[name="Major"]').append('<option value="">Selecteer een afstudeerrichting</option>');
                    $.each(data, function(key, value){

                        $('select[name="Major"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="Major"]').empty();
            $('select[name="Major"]').append('<option value="">Selecteer eerst een opleiding</option>');
        }

    });

});