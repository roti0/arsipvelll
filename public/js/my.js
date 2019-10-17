$(document).ready(function () {
    console.log('mantap')
    $('#divisi').on('change',function(ae){
        console.log(ae);
        var divisi_id = ae.target.value;
        $.get('/ajax/'+ divisi_id,function (data) {
            $('#job').empty();
            $('#job').append('<option value="0" disabled selected >--Choose Job--</option>');
            $.each(data,function (_index,jobObj) {
            $('#job').append('<option value="'+jobObj.id_jobs+'">'+jobObj.job_name+'</option>');
            });
        });
    });
});