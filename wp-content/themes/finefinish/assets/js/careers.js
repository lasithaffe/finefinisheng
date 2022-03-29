/**
 * Created by Tauseef on 8/9/2018.
 */

(function($){

    var baseUrl         = $('.logo a').attr('href');

    $(document).on('change', '#departments', function(){
        var department = $(this).val();
        getCareers(department);
    });

    $(document).on('click', '.car-main li', function(){
        $('.car-main li').removeClass("act");
        $(this).addClass("act");

    });
    $('.file-cr input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.file-cr span').text(fileName);
    });

    $.validate({
        form: "#career_form",
        modules : 'file'
    });

    function getCareers(slug){
        $.ajax({url: baseUrl+"/wp-json/api/careers/get",
            type    : 'GET',
            crossDomain: true,
            datatype: 'application/json',
            data    : {
                slug      : slug,
            },
            success: function(result){
                $('ul.car-main').html(" ");
                $('#job_position').html("<option value='Any'>Any</option>");
                $.each(result, function(id,val){
                    item = '<li>';
                    item += '<div><span>'+val.date+'</span><h4>'+val.title+'</h4></div>';
                    item += '<div class="car-deil">'+val.description+'<br><a href="#'+val.title+'" data-name="'+val.title+'">Apply this Position</a></div>';
                    item += '</li>';

                    option = '<option value="'+val.title+'">'+val.title+'</option>';

                    $('ul.car-main').append(item);
                    $('#job_position').append(option);
                });
            }
        });
    }

    $(document).on('click', '.car-deil a', function(){
        val = $(this).data('name');
        $('#job_position').val(val).attr("selected", "selected");
    });

})(jQuery);