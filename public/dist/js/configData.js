
$(function() {
    var site_url = $('.site_url').val();
    // $( ".ad_start_date" ).datepicker();
    $( ".ad_start_date" ).datepicker();
    $( ".ad_end_date" ).datepicker();
    var date_status = 0;

    var fit_start_time = ''; var date_status = 0;
    $( ".ad_start_date" ).on('change', function (e){
        fit_start_time = new Date($(this).val());
        if(fit_start_time > fit_end_time)
        {
            date_status = 1;
        }
    })
    var fit_end_time = ''
    $( ".ad_end_date" ).on('change', function (e){
        fit_end_time = new Date($(this).val());
        date_status = 0;
        if(fit_start_time > fit_end_time)
        {
            date_status = 1
        }
    })

    $('.campaignAdBtn').on('click', function (e){
        e.preventDefault();
        if(date_status == 1){
            alert('Fix date please.');
            return false;
        }
        var form_data = new FormData();

        // Read selected files
        var totalfiles = document.getElementById('files').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("ad_images[]", document.getElementById('files').files[index]);
        }
        form_data.append('ad_title', $('.ad_title').val());
        form_data.append('ad_start_date', $('.ad_start_date').val());
        form_data.append('ad_end_date', $('.ad_end_date').val());
        form_data.append('ad_daily_price', $('.ad_daily_price').val());
        $.ajax({
            url: site_url+ '/api/v1/ad',
            type: 'post',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response){

            },
        });
    });
// console.log(new Date(fit_start_time) + ' ' + fit_end_time)

});
