$(document).ready(function() {
    $('.phone-mask').mask("+7 (999) 999-99-99");
    $('.focus').focus(function() {
        var val = $(this).val();
        var hidden = $(this).parent('.field').find('.hidden').val();
        if (val == hidden) {
            $(this).val('');
        }
    }).focusout(function() {
        var val = $(this).val();
        var hidden = $(this).parent('.field').find('.hidden').val();
        if (val.length == 0) {
            $(this).val(hidden);
        }
    });
});