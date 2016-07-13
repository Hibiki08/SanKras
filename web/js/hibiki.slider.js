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
            overStop: false //Будет ли слайдер останавливаться при наведении
        };

        var options = $.extend(defoultOptions, _options);

        return $(this).each(function() {
            var thisElement = $(this),
                images = thisElement.find('.wrap img').attr('height', 'auto'),
                numberOfImages = images.length,
                imgWidth = images[0].clientWidth,
                realWidth = images[0].naturalWidth,
                blockWrapperWidth,
                sliderWrapper = thisElement.find('.sliderWrapper'),
                sliderWrapperWidth,
                wrap = thisElement.find('.wrap'),
                wrapWidth,
                HbKSlider,
                wrapArrowsWidth,
                Blockswrapper = thisElement.find('.Blockswrapper'),
                firstElemnt,
                lastElemnt,
                indexButton,
                thisImage,
                thisActive,
                banSlide = 0;


            //Размер слайдера
            function sliderSize() {
                if (options.sliderSize >= numberOfImages) {
                    options.sliderSize = numberOfImages - 1
                }
                HbKSlider = thisElement.width();
                sliderWrapperWidth = options.imageSize * options.sliderSize || options.sliderSize * realWidth;

                if (sliderWrapperWidth >= HbKSlider) {
                    sliderWrapperWidth = HbKSlider;
                }
                else {
                    sliderWrapperWidth = options.imageSize * options.sliderSize || options.sliderSize * realWidth;
                }

                sliderWrapper.css('width', sliderWrapperWidth + 'px');
                wrapWidth = sliderWrapperWidth / options.sliderSize;
                blockWrapperWidth = wrapWidth * images.length;
                thisElement.find('.wrap').css('width', wrapWidth + 'px');
                Blockswrapper.css({
                    width: blockWrapperWidth + 'px'
                });
            }

            //Показать слайдер после загрузки
            function opacityNone() {
                Blockswrapper.find('.wrap').css('opacity', 1);
            }

            //Смещение вправо
            function nextSlide() {
                if (banSlide == 0) {
                    banSlide = 1;
                    firstElemnt = Blockswrapper.find('.wrap').eq(0);
                    thisActive = Blockswrapper.children('.wrap').eq(1).attr('id');
                    Blockswrapper.stop().animate({
                        marginLeft: -wrapWidth
                    }, options.animationSpeed, function() {
                        Blockswrapper.append(firstElemnt).css('margin-left', 0);
                        banSlide = 0;
                    });
                    if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                        autoActive();
                    }
                }

            }

            //Смещение влево
            function prevSlide() {
                if (banSlide == 0) {
                    banSlide = 1;
                    lastElemnt = Blockswrapper.find('.wrap').eq(-1);
                    Blockswrapper.prepend(lastElemnt).css({marginLeft: -wrapWidth}).stop().animate({
                        marginLeft: 0
                    }, options.animationSpeed, function() {
                        banSlide = 0;
                    });
                    return thisActive = Blockswrapper.find('.wrap').eq(0).attr('id');
                }
            }

            //navigationArrows
            function navigationArrows() {
                var sliderArrows = thisElement.find('.sliderArrows');
                var wrapArrows = thisElement.find('.wrapArrows');

                if (options.sliderSize >= numberOfImages) {
                    options.sliderSize = numberOfImages - 1
                }
                HbKSlider = thisElement.width();
                sliderWrapperWidth = options.imageSize * options.sliderSize || options.sliderSize * realWidth;
                wrapArrowsWidth = sliderWrapperWidth + 80;

                if (wrapArrowsWidth >= HbKSlider) {
                    wrapArrowsWidth = HbKSlider;
                    sliderWrapperWidth = wrapArrowsWidth - 80;
                }
                else {
                    sliderWrapperWidth = options.imageSize * options.sliderSize || options.sliderSize * realWidth;
                    wrapArrowsWidth = sliderWrapperWidth + 80;
                }

                wrapArrows.width(wrapArrowsWidth);
                sliderWrapper.width(sliderWrapperWidth);
                wrapWidth = sliderWrapperWidth / options.sliderSize;
                blockWrapperWidth = wrapWidth * images.length;
                thisElement.find('.wrap').css('width', wrapWidth + 'px');
                Blockswrapper.css({
                    width: blockWrapperWidth + 'px'
                });

                //Центрование стрелок по-вертикали
                if (images.height() <= 63) {
                    sliderArrows.css('background-size', 'auto 100%');
                }
                else {
                    sliderArrows.css('background-size', '100% auto');
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
                                }, options.animationSpeed, function() {
                                    banSlide = 0;
                                });
                            }
                            thisActive = indexButton;
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

            //Условия отображения радио кнопок
            function autoActiveCheck() {
                if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                    autoActive();
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
                navigationArrows();
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
                    navigationArrows();
                });
            }
            else {
                opacityNone();
                sliderSize();
                autoActive();
                autoPlay();
                $(window).resize(function() {
                    sliderSize();
                });
            }
        });
    }
})(jQuery);