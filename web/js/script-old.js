$(document).ready(function () {
    var headerHeight, windowWidth = $(window).width(), windowHeight = $(window).height(),
    first, sumHeight;

    function headerPosition() {
        //headerHeight = $('#header').innerHeight();
        //console.log(headerHeight);
        windowWidth = $(window).width();
        if (windowWidth <=750 || windowHeight <= 600){
            $('#header').css('position', 'relative');
            //$('.content-wrapper').css('top', 0);
        }
        else {
            $('#header').css('position', 'fixed');
            //$('.wrapper').css('top', headerHeight + 'px');
        }
    }

    function serviceAnimate() {
        if (windowWidth >= 1134) {
            $('.blocks > div').mouseenter(function() {
                $(this).children('.services').stop().animate({
                    top: 0,
                    opacity: 1
                }, 300);
            }).mouseleave(function() {
                $(this).children('.services').stop().animate({
                    top: -290,
                    opacity: 0
                }, 300);
            });
        }
        else {
            $(this).children('.services').css('top', 0);
            $('.blocks > div').unbind();
        }
    }

    //Блок Итоговой суммы
    function positionSumFromScroll() {
        windowHeight = $(window).height();
        if ($('.sum').css('display') == 'block') {
            var sum = $('.sum');
            sum.css({
                position: 'relative',
                bottom: 'auto'
            });
            first = sum.offset().top; //Изначальное расположение от верха документа
            sumHeight = sum.height(); //Высота элемента
            var pageTop = parseInt($('.page-price').css('top')); //Отступ врапера от шапки
            var headerHeightScroll = $('#header').css('position') == 'fixed' ? headerHeight : 0;
            function scrollWindow() {
                var stepOne = windowHeight + sumHeight - 15 - headerHeightScroll - pageTop;
                var stepTwo = $('#header').css('position') == 'fixed' ? stepOne + 40 : stepOne - 40;
                var scroll = stepTwo + $(window).scrollTop();
                if (first > scroll) {
                    $('.sum').css({
                        position: 'fixed',
                        bottom: '15px'
                    });
                }
                else {
                    $('.sum').css({
                        position: 'relative',
                        bottom: 'auto'
                    });
                }
            }
            scrollWindow();
            $(window).scroll(function() {
                scrollWindow();
            });
        }
    }

    //Пролистывание до подразделов таблицы
    function scrollTableTitleChild() {
        headerHeight = $('#header').height();
        windowWidth = $(window).width();
        $('.sidebar .sub-menu a').on('click' ,function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            var top = $(link).offset().top;
            var scrollTop;
            if (windowWidth <=750 || windowHeight <= 600){
                scrollTop = top;
            }
            else {
                scrollTop = top - headerHeight;
            }
            $('html').animate({
                scrollTop: scrollTop
            }, 500);
            $('body').animate({
                scrollTop: scrollTop
            }, 500);
        });
    }

    //Кнопка наверх
    function buttonUp() {
            function checkPositionButton() {
                if ($('ul').is('.captions')) {
                    var scrollTop = $(window).scrollTop();
                    var captionsTop = $('.captions>li:last-of-type').offset().top;
                    var footerTop = $('.footer').offset().top;
                    var footerHeight = $('.footer').height();
                    var scroll = scrollTop + footerHeight;
                    if (scrollTop >= captionsTop) {
                        $('.position-up').show(500);
                    }
                    else {
                        $('.position-up').hide(500);
                    }

                    if (scroll >= footerTop) {
                        $('.up').css('position', 'absolute');
                    }
                    else {
                        $('.up').css('position', 'fixed');
                    }

                    console.log(scrollTop);
                    console.log(footerHeight);
                    console.log(scroll);
                    console.log(footerTop);
                }
            }
            checkPositionButton();
            $(window).scroll(function() {
                checkPositionButton();
            });

            $('.up').click(function() {
                $('body').animate({
                    scrollTop: 0
                }, 500);
                $('html').animate({
                    scrollTop: 0
                }, 500);
            });
    }

    //Tabs
    $('.main-content .options-block .services menu li a').click(function(e) {
        e.preventDefault();
        $('.main-content .options-block .services menu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        var category = $(this).attr('href').split('/')[1];
        var name = $(this).attr('href').split('#')[1];
        $('.content .main-content .' + category).each(function() {
            $(this).removeClass('water');
            $(this).removeClass('hot');
            $(this).removeClass('sewerage');
            $(this).removeClass('sanfayans');
        }).addClass(name);
        var file = category + '-' + name + '.html';
        $('.main-content .description').load('/wp-content/themes/MainTheme/another-templs/' + file);
    });
    $(window).load(function() {
        if ($('div').is('.options-block')) {
            var url = window.location;
            var category = url.pathname.split('/')[1];
            var name = url.hash.split('#')[1];
            var file = category + '-' + name + '.html';
            $('.main-content .description').load('/wp-content/themes/MainTheme/another-templs/' + file);
            console.log(category);
            console.log(name);
        }
    });

    $(window).load(function() {
        headerHeight = $('#header').height();
        //headerPosition();
        serviceAnimate();
        positionSumFromScroll();
        scrollTableTitleChild();
        buttonUp();
    });
    //headerPosition();
    //$(window).resize(function() {
    //    headerHeight = $('#header').height();
    //    windowWidth = $(window).width();
    //    if (windowWidth <= 349 || windowWidth >= 1134) {
    //        $('.menu').css('display', 'block');
    //    }
    //    else {
    //        $('.menu').css('display', 'none');
    //    }
    //    headerPosition();
    //    serviceAnimate();
    //    positionSumFromScroll();
    //    scrollTableTitleChild();
    //    buttonUp();
    //});

    //Страница "Цены" Таблица
    $('.ceil.hover').mouseover(function() {
        var table = $(this).parent().parent().attr('class');
        if (table.indexOf('green') > -1) {
            $(this).parent().css('background', '#f2fcf3');
        }
        else if (table.indexOf('blue') > -1) {
            $(this).parent().css('background', '#f0fafd');
        }
        else if (table.indexOf('red') > -1) {
            $(this).parent().css('background', '#fdf2f0');
        }
        else if (table.indexOf('orange') > -1) {
            $(this).parent().css('background', '#fef5f0');
        }
        else if (table.indexOf('grey-blue') > -1) {
            $(this).parent().css('background', '#dde3e8');
        }
        else if (table.indexOf('lime') > -1) {
            $(this).parent().css('background', '#f6fbeb');
        }
        else if (table.indexOf('grey') > -1) {
            $(this).parent().css('background', '#efefef');
        }
        else if (table.indexOf('aquamarine') > -1) {
            $(this).parent().css('background', '#e8faf8');
        }
    }).mouseout(function() {
        $(this).parent().css('background', '#ffffff');
    });

    $('.sub-menu li').on('click', function(e) {
        e.stopPropagation();
    });

    //Правое меню
    $('.sidebar .captions li').on('click', function(e) {
        var parentUl = $(this).parent().attr('class');
        if (parentUl != 'sub-menu') {
            $('li .mark').each(function() {
                $(this).removeClass('rotate-right');
            });
            $(this).find('.mark').addClass('rotate-right');
            if ($(this).find('.sub-menu').css('display') == 'none') {
                $('.sub-menu').each(function() {
                    $(this).slideUp('slow');
                });
                $(this).find('.sub-menu:hidden').slideDown('slow');
            }
            else {
                if ($(this).find('.mark').hasClass('rotate-right')) {
                    $(this).find('.mark').removeClass('rotate-right');
                }
                $(this).find('.sub-menu:visible').slideUp('slow');
            }
        }
    });

    //Кнопка калькулятора
    var calcActive = 0;
    $('#calculator').on('click', function() {
        if (calcActive == 0) {
            calcActive = 1;
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.1--.png") no-repeat',
                width: '20px',
                height: '28px'
            });
            $('.table .hide').css('display', 'table-cell');
            $(this).find('span').html('Вернуться к просмотру');
            $('.ceil.price, .ceil.number').css('width', '74px');
            $('.sum').css('display', 'block');

            $('.table').each(function() {
                $(this).find('.value.number').each(function() {
                    var val = $(this).html();
                    if (val.indexOf('%') > -1) {
                        $(this).html('<input class="price-val" type="text" title="Цена монтажа составляет 30% \n от стоимости оборудования.\n Введите полную стоимость."><input type="hidden">');
                        $(this).find('input[type="hidden"]').val(val);
                    }
                });
            });

            positionSumFromScroll();
        }
        else {
            calcActive = 0;
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.0-.png") no-repeat',
                width: '20px',
                height: '28px'
            });
            $(this).find('span').html('Рассчитать стоимость');
            $('.ceil.price, .ceil.number').removeAttr('style');
            $('.table').each(function() {
                $(this).find('.value.number').each(function() {
                    var vals = $(this).html();
                    if (vals.indexOf('input') > -1) {
                        var hiddenVal = $(this).find('input[type="hidden"]').val();
                        $(this).html(hiddenVal);
                    }
                });
            });
            $('.sum').css('display', 'none');
            $('.table .hide').css('display', 'none');
        }
    });


    $('#calculator').mouseover(function() {
        if (calcActive == 0) {
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.0-.png") no-repeat'
            });
        }
        else {
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.1--.png") no-repeat'
            });
        }
    }).mouseout(function() {
        if (calcActive == 0) {
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.0.png") no-repeat'
            });
        }
        else {
            $(this).find('.ico').css({
                background: 'url("/wp-content/themes/MainTheme/images/about.1..png") no-repeat'
            });
        }

    });

    //Калькулятор
    $('.table-row').keyup(function() {
        var quantity = isNaN(parseInt($(this).find('.input input').val())) != true ? parseInt($(this).find('.input input').val()) : 0;
        if (quantity != 0) {
            $(this).find('.input input').val(quantity);
        }
        else {
            $(this).find('.input input').val('');
        }

        var price = $(this).find('.value.number').html();
        var res;
        var total = 0;
        var result = [];
        if (price.indexOf('input') > -1) {
            var priceVal = isNaN(parseInt($(this).find('.value.number .price-val').val())) != true ? parseInt($(this).find('.value.number input').val()) : 0;
            if (priceVal != 0) {
                $(this).find('.value.number .price-val').val(priceVal);
            }
            else {
                $(this).find('.value.number .price-val').val('');
            }
            var procent = parseInt($(this).find('input[type="hidden"]').val());
            res = (priceVal / 100 * procent) * quantity;
            if (isNaN(res) == true || '') {
                res = 0;
            }
            $(this).find('.total').html(Math.round(res));
        }
        else if (price.indexOf('от') > -1) {
            var priceFrom = parseInt(price.replace('от', '').trim());
            res = quantity * priceFrom;
            $(this).find('.total').html(res);
        }
        else {
            res = quantity * price;
            $(this).find('.total').html(res);
        }
        $('.table').each(function() {
            $(this).find('.total').each(function() {
                var temp = $(this).html();
                result.push(temp);
            });
        });
        for (var b = 0; b < result.length; b++) {
            total += Number(result[b]);
        }
        $('.sum .result .res').html(total);
    });

    //Распечатать
    $('.print').on('click', function(e) {
            var tableDatas = [];
            var rowName;
            var newRowName;
            var input;
            var un;
            var number;
            var total;
            var d = 0;
            var result = 0;
            $('.table').each(function() {
                $(this).find('.total').each(function() {
                    if ($(this).html() != 0) {
                        rowName = $(this).parent('.table-row').find('.service').text();
                        input = $(this).parent('.table-row').find('.input input').val();
                        un = $(this).parent('.table-row').find('.un').text();
                        number = $(this).parent('.table-row').find('.number').text() || $(this).parent('.table-row').find('.number .price-val').val();
                        total = $(this).parent('.table-row').find('.total').text();
                        result += Number(total);

                        tableDatas[d] = [rowName, input, un, number, total];
                        d++;
                    }
                });
            });
        if (result == 0) {
            e.preventDefault();
            return false;
        }
        else {
            $.ajax({
                type: 'POST',
                url: '/prices/print/',
                async: false,
                data: {tableDatas: tableDatas,
                    res: result}
            });
        }
    });

    //Очистить значения
    $('.reset').click(function() {
        $('.table').each(function() {
            $(this).find('.input input').each(function() {
                $(this).val('');
            });
            $(this).find('.value.number .price-val').each(function() {
                $(this).val('');
            });
            $(this).find('.total').each(function() {
                $(this).html(0);
            });
        });
        $('.sum .result .res').html(0);
    });

    $('.cat-works .works .sub-menu li.current-menu-item').css('background', '#e1e5e6').parent().css('display', 'block');

    //Подписи к картинкам ("Наши работы")
    if ($('div').is('#allinone_bannerWithPlaylist_pureGallery')) {
        for (var i = 1; $('div').is('#photoText' + i); ++i) {
            $('#photoText' + i).text($('li[data-text-id=#photoText' + i + '] > img').attr('alt'));
        }
    }

    if ($('figcaption')) {
        $('figcaption').each(function() {
            if ($.trim($(this).text()).length > 28) {
                $(this).css({
                    padding: '5.3% 4%'
                });
            }
        });
    }
});


//var menuBlock = function() {
//    var dis = document.getElementById('main').style.display;
//    var windowWidth = window.innerWidth;
//    if (windowWidth < 520) {
//        if (dis == 'block') {
//            document.getElementById('main').style.display='none';
//            //document.getElementById('phone').style.bottom='15px';
//
//        }
//        else {
//            document.getElementById('main').style.display='block';
//            //document.getElementById('phone').style.bottom='49px';
//        }
//    }
//    else {
//        $(document).ready(function () {
//            //document.getElementById('phone').style.bottom='auto';
//            $('#main').slideToggle();
//        });
//    }
//};

