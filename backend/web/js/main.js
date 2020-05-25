$(function() {
    //get the click of the create button
    $('#modalButton2').click(function (){
        $('#modal2').modal('show').find('#modalContent2').load($(this).attr('value'));
    });
});