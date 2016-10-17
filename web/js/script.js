$(document).ready(function() {
    $('.phone-mask').mask("+7 (999) 999-99-99");
    var focusVal = '';

    $('.focus').focus(function() {
        focusVal = $(this).attr('placeholder');
        $(this).attr('placeholder', '');
    }).focusout(function() {
        $(this).attr('placeholder', focusVal);
        if ($(this).val().length == 0) {
            $(this).attr('placeholder', focusVal);
        }
    });

    //Шапка
    $(document).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > 0) {
            $('#header .description').slideUp();
        } else {
            $('#header .description').slideDown();
        }
    });

    // Объект для которого будет применён эффект
    $(".pulse").click(function(e) {
        var ripple = $(this);
        // визуальный элемент эффекта
        if(ripple.find(".effekt").length == 0) {
            ripple.append("<span class='effekt'></span>");
        }
        var efekt = ripple.find(".effekt");
        efekt.removeClass("replay");
        if(!efekt.height() && !efekt.width())
        {
            var d = Math.max(ripple.outerWidth(), ripple.outerHeight());
            efekt.css({height: d/5, width: d/5});// Определяем размеры элемента эффекта
        }
        var x = e.pageX - ripple.offset().left - efekt.width()/2;
        var y = e.pageY - ripple.offset().top - efekt.height()/2;
        efekt.css({
            top: y+'px',
            left: x+'px'
        }).addClass("replay");
    });

    //Дисконтная карта
    $('.card button').click(function() {
        var cardMail = $(this).parents('.field').find('input[name=email]').val();
        var hiddenMail = $(this).parents('.field').find('input[type=hidden]').val();

        if (cardMail == hiddenMail) {
            $(this).parents('.field').find('input[name=email]').addClass('error');
            return false;
        }

        $('.card .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.card .form .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'get',
            dataType: 'json',
            data: {cardMail: cardMail},
            success: function (response) {
                if (response.status == true) {
                    $('.card .form .success, .card .form .close').css('display', 'block');
                    $('.card .form .loading').css('display', 'none');
                    $('.card .form .success span').css('visibility', 'visible');
                }
            },
            error: function () {
            }
        });
    });

    //Вызов мастера
    $('.master button').click(function() {
        var errors = false;
        var masterName = $(this).parents('.form').find('input[name=name]').val();
        var masterPhone = $(this).parents('.form').find('input[name=phone]').val();
        var hiddenName = $(this).parents('.form').find('input[type=hidden]').val();


        if (masterName == hiddenName) {
            $(this).parents('.form').find('input[name=name]').addClass('error');
            errors = true;
        }
        if (masterPhone.length == 0) {
            $(this).parents('.form').find('input[name=phone]').addClass('error');
            errors = true;
        }

        if (errors) {
            return false;
        }
        $('.call-master .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.call-master .call .form .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'get',
            dataType: 'json',
            data: {masterName: masterName, masterPhone: masterPhone},
            success: function (response) {
                if (response.status == true) {
                    $('.call-master .form .success, .call-master .form .close').css('display', 'block');
                    $('.call-master .call .form .loading').css('display', 'none');
                    $('.call-master .form .success span').css('visibility', 'visible');
                    yaCounter39483720.reachGoal('master');
                }
            },
            error: function () {
            }
        });
    });

    //Обратный звонок
    $('.call-block .form button').click(function() {
        var callPhone = $(this).parents('.form').find('input[name=phone]').val();

        if (callPhone.length == 0) {
            $(this).parents('.form').find('input[name=phone]').addClass('error');
            return false;
        }
        $('.call-block .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.call-block .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'get',
            dataType: 'json',
            data: {callPhone: callPhone},
            success: function (response) {
                if (response.status == true) {
                    $('.call-block .form .success').css('display', 'block');
                    $('.call-block .form .success span').css('visibility', 'visible');
                    $('.call-block .loading').css('display', 'none');
                    yaCounter39483720.reachGoal('callback');
                }
            },
            error: function () {
            }
        });
    });

    //Напишите нам
    $('.cooperation .form').on('beforeSubmit', function() {
        WriteUs($(this));
        return false;
    });

    //Напишите нам
    var WriteUs = function (form) {
        var errors = false;
        var $this = form;
        var writeUsName = $this.find('#writeusform-name').val();
        var writeUsPhone = $this.find('#writeusform-phone').val();
        var writeUsEmail = $this.find('#writeusform-email').val();
        var writeUsMessage = $this.find('#writeusform-message').val();

        $('.cooperation .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.cooperation .form .loading').css('display', 'block');

        $.ajax({
            url: 'site/contacts',
            dataType: 'json',
            method: 'post',
            data: {
                writeUsName: writeUsName,
                writeUsPhone: writeUsPhone,
                writeUsMessage: writeUsMessage,
                writeUsEmail: writeUsEmail,
                _csrf: yii.getCsrfToken()
            },
            success: function (response) {
                if (response.status == true) {
                    $('.cooperation .form .success, .cooperation .form .close').css('display', 'block');
                    $('.cooperation .form .success span').css('visibility', 'visible');
                    $('.cooperation .form .loading').css('display', 'none');
                    yaCounter39483720.reachGoal('writeUs');
                }
            },
            error: function () {
            }
        });
    };

    //Закрыть (Напишите нам)
    $('.cooperation .form .close').click(function() {
        $('.cooperation .form #writeusform-name').val('');
        $('.cooperation .form #writeusform-phone').val('');
        $('.cooperation .form #writeusform-email').val('');
        $('.cooperation .form #writeusform-message').val('');
        $('.cooperation .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('.cooperation .form .success, .cooperation .form .close').css('display', 'none');
        $('.cooperation .form .success span').css('visibility', 'hidden');
    });

    $('input').focus(function() {
        if ($(this).hasClass('error')) {
            $(this).removeClass('error');
        }
    });
    $('textarea').focus(function() {
        if ($(this).parent('.textarea').hasClass('error')) {
            $(this).parent('.textarea').removeClass('error');
        }
    });

    //Форма обратного звонка
    $('.call-block').click(function(e) {
        var classHover = $(e.target).attr('class');
        if (classHover == 'block' || classHover == 'close') {
            $('.call-block').removeClass('visible');
            $('.call-block .form *:not(.close)').css('visibility', 'visible');
            $('.call-block .form .success').css('display', 'none');
            $('.call-block .form .success span').css('visibility', 'hidden');
            $('.call-block .form input').val('');
            $('.call-block .form button').html('перезвоните мне');
        }
    });

    $('#callback').click(function() {
        $('.call-block').addClass('visible');
    });

    //Закрыть "спасибо за заказ" (дисконтная карта)
    $('.card .form .close').click(function() {
        $('.card .form input[type=email]').val($('.card .form input[type=hidden]').val());
        $('.card .form *:not(.close)').css('visibility', 'visible');
        $('.card .form .success, .card .form .close').css('display', 'none');
        $('.card .form .success span').css('visibility', 'hidden')
    });

    //Закрыть "спасибо за заказ" (вызов мастера)
    $('.call-master .form .close').click(function() {
        $('.call-master .form input[name="name"]').val($('.call-master .form input[name="hide-name"]').val());
        $('.call-master .form input[name="phone"]').val('');
        $('.call-master .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('.call-master .form .success, .call-master .form .close').css('display', 'none');
        $('.call-master .form .success span').css('visibility', 'hidden')
    });

});