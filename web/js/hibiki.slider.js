(function($) {
    $.fn.HbKSlider = function(_options) {

        var defoultOptions = {
            sliderSize: 1, //Ширина слайдера в картинках
            navigationArrows: false, //Навигация по стрелкам
            navigationRadioButtons: false, //Навигация по радио кнопкам (только при "sliderSize: 1")
            imageSize: false, //Задать ширину картинки
            autoPlay: false, //Автоматическая прокрутка слайдов
            animationSpeed: 1000, //Скорость анимации слайдов в милесекундах
            sliderSpeed: 2500, //Скорость прокрутки слайдов в милесекундах
            overStop: false, //Будет ли слайдер останавливаться при наведении
            animation: 'carousel' //Способ перелистывания картинок ('fade', 'carousel')
        };

        var options = $.extend(defoultOptions, _options);

        return $(this).each(function() {
            var thisElement = $(this),
                images = thisElement.find('.wrap img'),
                numberOfImages = images.length,
                blockWrapperWidth,
                sliderWrapper = thisElement.find('.sliderWrapper'),
                sliderWrapperWidth,
                wrap = thisElement.find('.wrap'),
                wrapWidth,
                HbKSlider,
                Blockswrapper = thisElement.find('.Blockswrapper'),
                firstElemnt,
                lastElemnt,
                indexButton,
                thisActive,
                indexFade = 0,
                banSlide = 0;


            //Размер слайдера
            function sliderSize() {
                HbKSlider = thisElement.width();
                sliderWrapperWidth = HbKSlider;

                if (options.navigationArrows == true) {
                    var sliderArrows = thisElement.find('.sliderArrows');
                    var sliderArrowsPerc =  sliderArrows.width() * 100 / thisElement.width();
                    var sliderWrapperWidtPerc = 100 - sliderArrowsPerc;
                    sliderWrapperWidth = thisElement.find('.sliderWrapper').width(sliderWrapperWidtPerc + '%').width();
                }
                if (options.animation == 'carousel') {
                    if (options.sliderSize >= numberOfImages) {
                        options.sliderSize = numberOfImages - 1
                    }
                }
                if (options.animation == 'fade') {
                    options.sliderSize = 1;
                }

                wrapWidth = sliderWrapperWidth / options.sliderSize;
                blockWrapperWidth = wrapWidth * numberOfImages;

                if (options.animation == 'carousel') {
                    wrap.css('width', wrapWidth + 'px');
                    Blockswrapper.css('width', blockWrapperWidth + 'px');
                }
                if (options.animation == 'fade') {
                    //var imagesHeight = thisElement.find('.wrap[id=0]').css('position', 'relative').height();
                    //wrap.css('position', 'absolute');
                    //Blockswrapper.css({
                    //    height: imagesHeight
                    //});
                }
            }

            //Показать слайдер после загрузки
            function opacityNone() {
                Blockswrapper.find('.wrap').css('display', 'block');
            }

            //Смещение вправо
            function nextSlide() {
                if (banSlide == 0) {
                    banSlide = 1;
                    if (options.animation == 'carousel') {
                        firstElemnt = Blockswrapper.find('.wrap').eq(0);
                        thisActive = Blockswrapper.children('.wrap').eq(1).attr('id');
                        Blockswrapper.stop().animate({
                            marginLeft: -wrapWidth
                        }, options.animationSpeed, function() {
                            Blockswrapper.append(firstElemnt).css('margin-left', 0);
                            banSlide = 0;
                        });
                    }

                    if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                        autoActive();
                    }

                    if (options.animation == 'fade') {
                        indexFade++;
                        if (wrap.eq(indexFade).length > 0) {
                            wrap.removeClass('active');
                            wrap.eq(indexFade).addClass('active');
                            banSlide = 0;
                        }
                        else {
                            indexFade = 0;
                            wrap.removeClass('active');
                            wrap.eq(indexFade).addClass('active');
                            banSlide = 0;
                        }
                        removeActive();
                        checkButtons.children('li').eq(indexFade).addClass('active');
                        return thisActive = wrap.eq(indexFade).attr('id');
                    }
                }
            }

            //Смещение влево
            function prevSlide() {
                if (banSlide == 0) {
                    banSlide = 1;
                    lastElemnt = Blockswrapper.find('.wrap').eq(-1);
                    if (options.animation == 'carousel') {
                        Blockswrapper.prepend(lastElemnt).css({marginLeft: -wrapWidth}).stop().animate({
                            marginLeft: 0
                        }, options.animationSpeed, function () {
                            banSlide = 0;
                        });
                        return thisActive = Blockswrapper.find('.wrap').eq(0).attr('id');
                    }
                    if (options.animation == 'fade') {
                        indexFade--;
                        if (wrap.eq(indexFade).length > 0) {
                            wrap.removeClass('active');
                            wrap.eq(indexFade).addClass('active');
                            banSlide = 0;
                        }
                        else {
                            indexFade = wrap.length - 1;
                            wrap.removeClass('active');
                            wrap.eq(indexFade).addClass('active');
                            banSlide = 0;
                        }
                        removeActive();
                        checkButtons.children('li').eq(indexFade).addClass('active');
                        return thisActive = wrap.eq(indexFade).attr('id');
                    }
                }
            }

            //navigationRadioButtons
            if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                sliderWrapper.after('<div class="checkWrapper"><ul class="checkButtons"></ul></div>');
                Blockswrapper.find('.wrap').each(function() {
                    $(this).attr('id', $(this).index());
                });
                var checkButtons = thisElement.find('.checkButtons');
                for (var i = 0; i < images.length; i++) {
                    checkButtons.append('<li></li>');
                }
                checkButtons.find('li').eq(0).addClass('active');
                thisActive = 0;

                function removeActive() {
                    for (var i = 0; i < images.length; i++) {
                        checkButtons.children('li').removeClass('active');
                    }
                    return thisActive;
                }

                function slideImagesByActive() {
                    var res;
                    checkButtons.children('li').click(function (e) {
                        if (banSlide == 0) {
                            removeActive();
                            indexButton = $(this).addClass('active').index();

                            if (options.animation == 'fade') {
                                wrap.removeClass('active');
                                wrap.eq(indexButton).addClass('active');
                                indexFade = indexButton;
                            }

                            if (options.animation == 'carousel') {
                                if (indexButton > thisActive) {
                                    banSlide = 1;
                                    res = indexButton - thisActive;
                                    Blockswrapper.animate({
                                        marginLeft: -wrapWidth * res
                                    }, options.animationSpeed, function () {
                                        for (var slide = 0; slide < res; slide++) {
                                            firstElemnt = Blockswrapper.find('.wrap').eq(0);
                                            Blockswrapper.append(firstElemnt).css('margin-left', 0);
                                            banSlide = 0;
                                        }
                                    });
                                }
                                else if (indexButton < thisActive) {
                                    banSlide = 1;
                                    res = thisActive - indexButton;
                                    for (var slide = 0; slide < res; slide++) {
                                        lastElemnt = Blockswrapper.find('.wrap').eq(-1);
                                        Blockswrapper.prepend(lastElemnt).css('margin-left', -(res * wrapWidth));
                                    }
                                    Blockswrapper.animate({
                                        marginLeft: 0
                                    }, options.animationSpeed, function () {
                                        banSlide = 0;
                                    });
                                }
                                thisActive = indexButton;
                            }
                        }
                    });
                }

                function autoActive() {
                    removeActive();
                    checkButtons.children('li').eq(thisActive).addClass('active');
                }

                slideImagesByActive();
            }
            else {
                options.navigationRadioButtons = false;
            }


            //autoPlay
            function autoPlay() {
                if (options.autoPlay == true) {
                    var id;

                    //overStop
                    if (options.overStop == true) {
                        id = setInterval(nextSlide, options.sliderSpeed);
                        Blockswrapper.on('mouseover', function () {
                            clearInterval(id);
                        });
                        Blockswrapper.mouseout(function () {
                            id = setInterval(nextSlide, options.sliderSpeed);
                        });
                        if (options.navigationArrows == true) {
                            var sliderArrows = thisElement.find('.sliderArrows');
                            sliderArrows.mouseover(function () {
                                clearInterval(id);
                            });
                            sliderArrows.mouseout(function () {
                                id = setInterval(nextSlide, options.sliderSpeed);
                            });
                        }
                        if (options.navigationRadioButtons == true) {
                            checkButtons.mouseover(function () {
                                clearInterval(id);
                            });
                            checkButtons.mouseout(function () {
                                id = setInterval(nextSlide, options.sliderSpeed);
                            });
                        }
                    }
                    else {
                        id = setInterval(nextSlide, options.sliderSpeed);
                    }
                }
            }

            //Тип перелистывания
            if (options.animation == 'carousel') {
                thisElement.find('.wrap').addClass('carousel');
            }
            if (options.animation == 'fade') {
                thisElement.find('.wrap').addClass('fade');
                thisElement.find('.wrap').eq(0).addClass('active');
                //Blockswrapper.find('.wrap').css('display', 'block');
            }

            //Условия отображения радио кнопок
            function autoActiveCheck() {
                if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                    if (options.animation == 'carousel') {
                        autoActive();
                    }
                }
                else {
                    options.navigationRadioButtons = false;
                }
            }
            //Есть ли стрелки
            if (options.navigationArrows == true) {
                sliderWrapper.wrap('<div class="wrapArrows"></div>');
                thisElement.find('.wrapArrows').append('<div class="sliderArrows left"></div><div class="sliderArrows right"></div>');
                opacityNone();
                sliderSize();

                //Навигация по стрелкам
                var sliderArrowsLeft = thisElement.find('.sliderArrows.left');
                var sliderArrowsRight = thisElement.find('.sliderArrows.right');
                sliderArrowsLeft.click(function() {
                    prevSlide();
                    autoActiveCheck();
                });

                sliderArrowsRight.on('click', function() {
                    nextSlide();
                    autoActiveCheck();
                });
                autoPlay();
                $(window).resize(function() {
                    sliderSize();
                });
            }
            else {
                opacityNone();
                sliderSize();
                autoPlay();
                $(window).resize(function() {
                    sliderSize();
                });
            }
        });
    }
})(jQuery);