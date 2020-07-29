$(document).ready(function(){

    $('input[name="radioCheckPublish"]').click(function(){
        let target = $('#block-' + $(this).val());
        if ($(this).val() == 2) {
            $('.checkbox').find('#newsform-is_public').prop('checked', true);
        }

        $('.sub-check-block').not(target).hide(0);
        target.fadeIn(500);
    });

});