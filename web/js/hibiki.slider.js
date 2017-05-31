(function($) {
    $.fn.HbKSlider = function(_options) {
        var defoultOptions = {
            sliderSize: 1,
            navigationArrows: false,
            navigationRadioButtons: false,
            imageSize: false,
            autoPlay: false,
            animationSpeed: 1000,
            sliderSpeed: 2500,
            overStop: false,
            animation: 'carousel'
        };
        var options = $.extend(defoultOptions, _options);
        return $(this).each(function() {
            var thisElement = $(this),
                images = thisElement.find('.wrap img'),
                numberOfImages = images.length,
                blockWrapperWidth, sliderWrapper = thisElement.find('.sliderWrapper'),
                sliderWrapperWidth, wrap = thisElement.find('.wrap'),
                wrapWidth, HbKSlider, Blockswrapper = thisElement.find('.Blockswrapper'),
                firstElemnt, lastElemnt, indexButton, thisActive, indexFade = 0,
                banSlide = 0;

            function sliderSize() {
                HbKSlider = thisElement.width();
                if (options.imageSize) {
                    HbKSlider = options.imageSize * options.sliderSize;
                }
                sliderWrapperWidth = HbKSlider;
                if (options.navigationArrows == true) {
                    var sliderArrows = thisElement.find('.sliderArrows');
                    var sliderArrowsPerc = sliderArrows.width() * 100 / HbKSlider;
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
                if (options.imageSize) {
                    wrapWidth = options.imageSize;
                } else {
                    wrapWidth = sliderWrapperWidth / options.sliderSize;
                }

                blockWrapperWidth = wrapWidth * numberOfImages;
                if (options.animation == 'carousel') {
                    wrap.css('width', wrapWidth + 'px');
                    Blockswrapper.css('width', blockWrapperWidth + 'px');
                }
                if (options.animation == 'fade') {}
            }

            function opacityNone() {
                Blockswrapper.find('.wrap').css('display', 'block');
            }

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
                        } else {
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

            function prevSlide() {
                if (banSlide == 0) {
                    banSlide = 1;
                    lastElemnt = Blockswrapper.find('.wrap').eq(-1);
                    if (options.animation == 'carousel') {
                        Blockswrapper.prepend(lastElemnt).css({
                            marginLeft: -wrapWidth
                        }).stop().animate({
                            marginLeft: 0
                        }, options.animationSpeed, function() {
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
                        } else {
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
                    checkButtons.children('li').click(function(e) {
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
                                    }, options.animationSpeed, function() {
                                        for (var slide = 0; slide < res; slide++) {
                                            firstElemnt = Blockswrapper.find('.wrap').eq(0);
                                            Blockswrapper.append(firstElemnt).css('margin-left', 0);
                                            banSlide = 0;
                                        }
                                    });
                                } else if (indexButton < thisActive) {
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
                        }
                    });
                }

                function autoActive() {
                    removeActive();
                    checkButtons.children('li').eq(thisActive).addClass('active');
                }
                slideImagesByActive();
            } else {
                options.navigationRadioButtons = false;
            }

            function autoPlay() {
                if (options.autoPlay == true) {
                    var id;
                    if (options.overStop == true) {
                        id = setInterval(nextSlide, options.sliderSpeed);
                        Blockswrapper.on('mouseover', function() {
                            clearInterval(id);
                        });
                        Blockswrapper.mouseout(function() {
                            id = setInterval(nextSlide, options.sliderSpeed);
                        });
                        if (options.navigationArrows == true) {
                            var sliderArrows = thisElement.find('.sliderArrows');
                            sliderArrows.mouseover(function() {
                                clearInterval(id);
                            });
                            sliderArrows.mouseout(function() {
                                id = setInterval(nextSlide, options.sliderSpeed);
                            });
                        }
                        if (options.navigationRadioButtons == true) {
                            checkButtons.mouseover(function() {
                                clearInterval(id);
                            });
                            checkButtons.mouseout(function() {
                                id = setInterval(nextSlide, options.sliderSpeed);
                            });
                        }
                    } else {
                        id = setInterval(nextSlide, options.sliderSpeed);
                    }
                }
            }
            if (options.animation == 'carousel') {
                thisElement.find('.wrap').addClass('carousel');
            }
            if (options.animation == 'fade') {
                thisElement.find('.wrap').addClass('fade');
                thisElement.find('.wrap').eq(0).addClass('active');
            }

            function autoActiveCheck() {
                if (options.navigationRadioButtons == true && options.sliderSize == 1) {
                    if (options.animation == 'carousel') {
                        autoActive();
                    }
                } else {
                    options.navigationRadioButtons = false;
                }
            }
            if (options.navigationArrows == true) {
                sliderWrapper.wrap('<div class="wrapArrows"></div>');
                thisElement.find('.wrapArrows').append('<div class="sliderArrows left"></div><div class="sliderArrows right"></div>');
                opacityNone();
                sliderSize();
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
            } else {
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