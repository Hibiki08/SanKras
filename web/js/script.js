$(document).ready(function() {
    $('.phone-mask').mask("+7 (999) 999-99-99");
    var focusVal = '';
    var documentScroll = '';

    $('.focus').focus(function() {
        focusVal = $(this).attr('placeholder');
        $(this).attr('placeholder', '');
    }).focusout(function() {
        $(this).attr('placeholder', focusVal);
        if ($(this).val().length == 0) {
            $(this).attr('placeholder', focusVal);
        }
    });


    //Ссылки на таблицу
    $(window).load(function() {
        if ($('section').is('#price')) {
            var hash = window.location.hash;
            if (hash.length > 0) {
                if (hash != '#calc') {
                    $('.price .nav-menu > ul li').removeClass('active');
                    var $this = $('.price .nav-menu > ul li > a[href=' + hash + ']').parent('li').addClass('active');
                    $('.price .nav-menu > ul > li ul').css('display', 'none');
                    $this.parent('li').find('ul').stop().slideToggle();

                    $('.price .table table').removeClass('active');
                    $('.price .table table' + hash).addClass('active');
                }
            }

            if (window.location.hash == '#calc') {
                $('.price .tabs li').removeClass('active');
                $('.price .tabs .calc').addClass('active');
                $('.table table').addClass('calculater');
                $('.sum').css('display', 'block');

                sumPosition();
            }
        }
    });

    function headScroll() {
        var scroll = $(window).scrollTop();
        var description = $('#header .description');
        if (scroll > 0) {
            if (description.css('display') == 'block') {
                description.slideUp();
            }
        } else {
            if (description.css('display') == 'none') {
                description.stop().slideDown();
            }
        }
    }

    //Шапка
    $(document).scroll(function() {
        headScroll();
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
    $('#discount #form_discount').on('beforeSubmit', function() {
        var cardMail = $(this).find('#baseform-email').val();

        $('#discount .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('#discount .form .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'post',
            dataType: 'json',
            data: {
                cardMail: cardMail,
                _csrf: yii.getCsrfToken()
            },
            success: function (response) {
                if (response.status == true) {
                    $('#discount .form .success, #discount .form .close').css('display', 'block');
                    $('#discount .form .loading').css('display', 'none');
                    $('#discount .form .success span').css('visibility', 'visible');
                    yaCounter39483720.reachGoal('discount');
                }
            },
            error: function () {
            }
        });
        return false;
    });

    //Вызов мастера
    $('.master #form_call_master').on('beforeSubmit', function() {
        var masterName = $(this).find('#baseform-name').val();
        var masterPhone = $(this).find('#baseform-phone').val();

        $('.call-master .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.call-master .call .form .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'post',
            dataType: 'json',
            data: {
                masterName: masterName,
                masterPhone: masterPhone,
                _csrf: yii.getCsrfToken()
            },
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
        return false;
    });

    //Обратный звонок
    $('.call-block #form_callback').on('beforeSubmit', function() {
        var callPhone = $(this).find('#baseform-phone').val();

        $('.call-block .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('.call-block .loading').css('display', 'block');

        $.ajax({
            url: 'site/index',
            type: 'post',
            dataType: 'json',
            data: {
                callPhone: callPhone,
                _csrf: yii.getCsrfToken()
            },
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
        return false;
    });

    //Консультация мастера
    $('#advice .form').on('beforeSubmit', function() {
        var $this = $(this);
        var adviceName = $this.find('#baseform-name').val();
        var advicePhone = $this.find('#baseform-phone').val();
            $('#advice .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
            $('#advice .loading').css('display', 'block');

            $.ajax({
                url: 'site/index',
                type: 'post',
                dataType: 'json',
                data: {
                    advicePhone: advicePhone,
                    adviceName: adviceName,
                    _csrf: yii.getCsrfToken()
                },
                success: function (response) {
                    if (response.status == true) {
                        $('#advice .form .success, #advice .form .close').css('display', 'block');
                        $('#advice .form .success span').css('visibility', 'visible');
                        $('#advice .loading').css('display', 'none');
                        yaCounter39483720.reachGoal('callback');
                    }
                },
                error: function () {
                }
            });
        return false;
    });

    //Вопрос мастеру
    $('#more .form').on('beforeSubmit', function() {
        var $this = $(this);
        var questionName = $this.find('#baseform-name').val();
        var questionPhone = $this.find('#baseform-phone').val();
        var questionText = $this.find('#baseform-text').val();

        $('#more .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'hidden');
        $('#more .loading').css('display', 'block');

        $.ajax({
            url: 'site/flat',
            type: 'post',
            dataType: 'json',
            data: {
                questionPhone: questionPhone,
                questionName: questionName,
                questionText: questionText,
                _csrf: yii.getCsrfToken()
            },
            success: function (response) {
                if (response.status == true) {
                    $('#more .form .success, #more .form .close').css('display', 'block');
                    $('#more .form .success span').css('visibility', 'visible');
                    $('#more .loading').css('display', 'none');
                    yaCounter39483720.reachGoal('question');
                }
            },
            error: function () {
            }
        });
        return false;
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
        if ($(this).hasClass('has-error')) {
            $(this).removeClass('has-error');
        }
    });
    $('textarea').focus(function() {
        if ($(this).parent('.textarea').hasClass('has-error')) {
            $(this).parent('.textarea').removeClass('has-error');
        }
    });

    //Форма обратного звонка
    $('.call-block').click(function(e) {
        var element = $(e.target);
        if (element.parents('.block').length != 1 || element.attr('class') == 'close') {
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
        $('.card .form #baseform-email').val('');
        $('.card .form *:not(.close)').css('visibility', 'visible');
        $('.card .form .success, .card .form .close').css('display', 'none');
        $('.card .form .success span').css('visibility', 'hidden')
    });

    //Закрыть "спасибо за заказ" (вызов мастера)
    $('.call-master .form .close').click(function() {
        $('.call-master .form #baseform-name').val('');
        $('.call-master .form #baseform-phone').val('');
        $('.call-master .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('.call-master .form .success, .call-master .form .close').css('display', 'none');
        $('.call-master .form .success span').css('visibility', 'hidden')
    });

    //Закрыть "спасибо за отзыв" (отзывы)
    $('#opinions .form .close').click(function() {
        $('#opinions .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('#opinions .form .success, #opinions .form .close').css('display', 'none');
        $('#opinions .form .success span').css('visibility', 'hidden')
    });

    //Закрыть "консультация мастера" (бесплатная консультация мастера)
    $('#advice .form .close').click(function() {
        $('#advice .form #baseform-name').val('');
        $('#advice .form #baseform-phone').val('');
        $('#advice .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('#advice .form .success, #advice .form .close').css('display', 'none');
        $('#advice .form .success span').css('visibility', 'hidden')
    });

    //Закрыть вопрос мастеру
    $('#more .close').click(function() {
        $('#more .form #baseform-name').val('');
        $('#more .form #baseform-phone').val('');
        $('#more .form #baseform-text').val('');
        $('#more .form *:not(.close):not(.loading):not(.loading img)').css('visibility', 'visible');
        $('#more .form .success, #more .form .close').css('display', 'none');
        $('#more .form .success span').css('visibility', 'hidden')
    });


    //Правое меню
    $('.price .nav-menu > ul > li > a').click(function() {
        $('.price .nav-menu > ul li').removeClass('active');
        var id = $(this).attr('href').slice(1);
        $('.price .nav-menu > ul > li ul').stop().slideUp();
        var sub = $(this).parent('li').addClass('active').find('ul').stop().slideToggle();
        $('.price .table table').removeClass('active');
        $('.price .table table#' + id ).addClass('active');
        sumPosition();
    });
    //Правое меню. Подкатегории
    $('.price .nav-menu > ul > li > ul a').click(function(e) {
        e.preventDefault();
        $('.price .nav-menu > ul li > ul li').removeClass('active');
        $(this).parent('li').addClass('active');
        var id = $(this).attr('href').slice(1);
        var headerHeight = $('.header').innerHeight();
        $('body, html').animate({
            scrollTop: $('#' + id).offset().top - headerHeight
        }, 700);
    });

    //Калькулятор
    $('.calc').click(function() {
        $('.price .tabs li').removeClass('active');
        $(this).addClass('active');
        $('.table table').addClass('calculater');
        $('.sum').css('display', 'block');
        sumPosition();
    });

    $('.table-number input').focus(function() {
        var val = $(this).val();
        if (val == 0) {
            $(this).val('');
        }
    }).focusout(function() {
        var val = $(this).val();
        if (val == '') {
            $(this).val(0);
        }
    }).keyup(function() {
        var val = parseInt($(this).val());
        val = isNaN(val) ? '' : val;
        $(this).val(val);
        var price = parseInt($(this).parents('tr').find('.table-price').text());
        val = val == '' ? 0 : val;
        var cost = val * price;
        $(this).parents('tr').find('.table-cost').text(cost);
        cost = 0;
        $('.table table .table-cost').each(function() {
            cost += isNaN(parseInt($(this).text())) ? 0 : parseInt($(this).text());
            $('.sum .result .res').html(cost);
        });

        var data = {};
        var print = false;
        $('.table-number').each(function() {
            if ($(this).find('input').val() != 0) {
                print = true;
                data[$(this).data('id')] = {
                    id : $(this).data('id'),
                    tableNumber : $(this).find('input').val(),
                    tableCost : $(this).parents('tr').find('.table-cost').text()
                };
            }
        });

        if (print) {
            document.cookie = 'data_print=' + JSON.stringify(data);
        }
    });

    //Очистить всё
    $('.reset').click(function() {
        $('.table-number input').val(0);
        $('.table-cost.hidden').text(0);
        $('.sum .result .res').text(0);
        var date = new Date();
        date.setMinutes(23-date.getMinutes());
        document.cookie = 'data_print=';
    });

    //Вверх
    $('.price .up').click(function() {
        $('body, html').animate({
            scrollTop: 0
        }, 300);
    });

    //Кнопка "Видео"
    $('.work .head .button-video').click(function() {
        var top = $('.work .info .video').offset().top;
        var headerHeight = $('.header').innerHeight();
        $('body, html').animate({
            scrollTop: top - headerHeight
        }, 300);
    });

});

//Панель с итогом у Калькулятора
function sumPosition() {
    var table = $('.price table.active');
    var sum = $('.sum');
    var documentScroll = $(window).scrollTop() + $(window).height() - sum.height();
    var heightTable = table.height();
    var limitTable = table.offset().top + heightTable;
    if (documentScroll < limitTable) {
        sum.css('position', 'fixed');
    } else {
        sum.css('position', 'relative');
    }
}

//Кнопка вверх
function buttonUp() {
    var menu = $('.price .nav-menu');
    var button = $('.price .up');
    var footer = $('footer');
    var heightMenu = menu.height();
    var limitMenu = menu.offset().top + heightMenu;
    var documentScroll = $(window).scrollTop() + $(window).height() - button.height() - 380 - 40;
    var limitFooter = footer.offset().top;

    if (documentScroll > limitMenu) {
        button.css({
            display: 'block'
            //right: 'inherit'
        })
    } else {
        button.css({
            display: 'none'
            //right: '-50%'
        })
    }
}