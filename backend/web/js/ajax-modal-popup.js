console.log('Saya');
$(function() {

    $(document).on('click', '.showModalButton', function() {
        if ($('#modal').data('bs.modal').isShown) {
            
            $('#modal').find('#modalContent').load($(this).attr('value'));
            $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');

        } else {

            $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');
        
        } 
    });
});

$(function() {
    $(document).on('click', '.showCloseButton', function() {
        $('#modal').modal('hide');
    });
});

$(function(){
    //load the current page with the conten indicated by 'value' attribute for a given button.
       $(document).on('click', '.loadMainContent', function(){
                $('#main-content').load($(this).attr('value'));
        });
});

