(function($) {
    'use strict';
    if(typeof ScrollMagic == 'undefined' || typeof BB_SCENES == 'undefined') {
		return;
    }

    $.each(BB_SCENES, function (index, scene) {
        // Continue
        if (typeof scene.misc.disableMobile == 'undefined' && typeof scene.misc.disableMobile == 'disableDesktop') {
            return true;
        }
        if ( scene.misc.disableMobile == 'on' && BB_DEVICE == 'mobile' ) {
            delete BB_SCENES[index];
        }
        if (scene.misc.disableDesktop == 'on' && BB_DEVICE == 'desktop') {
            delete BB_SCENES[index];
        }
    });
    
    // Preload images - v2.7.1
    $.fn.preload = function() {
        this.each(function(){
            $('<img/>')[0].src = this;
        });
    };

    var bbsmController = new ScrollMagic.Controller();
    var bbsmController_h = new ScrollMagic.Controller( {vertical: false} );
        
    $('document').ready(function() {
        
        $('body').prepend('<span id="bbsm-trigger-top-document" class="bb-scrollmagic-trigger"></span>');
        
        $.each(BB_SCENES, function(key, value) {
            var counter = 1;
            var settings = value.settings;
            var init = value['init'];
            var tween = value['tween'];
            var misc = value['misc'];
            var bezier = value['bezier'];
            var controller;
            if(typeof settings.general.vertical != undefined && settings.general.vertical == 'off') {
                if(typeof misc.container != 'undefined' && misc.container != '' && $(misc.container).length > 0) {
                    controller = new ScrollMagic.Controller( { container: misc.container , vertical: false} );
                } else {
                    controller = bbsmController_h;
                }
            } else {
                if(typeof misc.container != 'undefined' && misc.container != '' && $(misc.container).length > 0) {
                    controller = new ScrollMagic.Controller( {container: misc.container} );
                } else {
                    controller = bbsmController;
                }
            }
            
            if (typeof misc.selector !== 'undefined' && misc.selector != '' && $(misc.selector).length > 0) {
                $('body ' + misc.selector).each(function() {
                    var $self = $(this);
                    var trigger = '';
                    if(typeof settings.general.triggerElement != undefined) {
                        trigger = settings.general.triggerElement;
                    } 
                    if(trigger == 'top-document') {
                        trigger = 'bbsm-trigger-top-document';
                    } else {
                        trigger = 'bbsm-trigger-selector-'+key+'-'+(counter++);
                        $self.before('<span id="'+trigger+'" class="bb-scrollmagic-trigger"></span>');
                    }
                    
                    bbsm_scrollmagic($self, settings, init, tween, misc, bezier, trigger, controller);
                });
            }
            
            $('body .' + key).each(function() {
                
                var $self = $(this);
                var trigger = '';
                if(typeof settings.general.triggerElement != undefined) {
                    trigger = settings.general.triggerElement;
                }
                if(trigger == 'top-document') {
                    trigger = 'bbsm-trigger-top-document';
                } else {
                    trigger = 'bbsm-trigger-'+key+'-'+(counter++);
                    $self.before('<span id="'+trigger+'" class="bb-scrollmagic-trigger"></span>');
                }
                
                bbsm_scrollmagic($self, settings, init, tween, misc, bezier, trigger, controller);
            });
        });
        

        $('[data-scrollmagic="true"]').each(function() {
            var $self = $(this);
            var settings = ($self.data('bbsm-settings'));
            var init = ($self.data('bbsm-init'));
            var tween = ($self.data('bbsm-tween'));
            var misc = ($self.data('bbsm-misc'));
            var bezier = ($self.data('bbsm-bezier'));
            var trigger = ($self.data('bbsm-trigger'));

            bbsm_scrollmagic($self, settings, init, tween, misc, bezier, trigger);
        });

        // Dots Navigation
        // Cache selectors
        var lastId,
            topMenu = $("#top-menu"),
            topMenuHeight = 0,//topMenu.outerHeight() + 15,
            // All list items
            menuItems = $(".wpsm-dots-navigation a"),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function () {
                var item = $($(this).attr("href"));
                if (item.length) {
                    return item;
                }
            });

        // Bind click handler to menu items
        // so we can get a fancy scroll animation
        menuItems.click(function (e) {
            var href = $(this).attr("href"),
                offsetTop = href === "#" ? 0 : $(href).offset().top - topMenuHeight;
            $('html, body').stop().animate({
                scrollTop: offsetTop
            }, 300);
            if(window.history && window.history.pushState) {
                history.pushState("", document.title, $(this).attr("href"));
            }
            e.preventDefault();
        });

        // Bind to scroll
        $(window).scroll(function () {
            // Get container scroll position
            var fromTop = $(this).scrollTop() + topMenuHeight;
            // Get id of current scroll item
            var cur = scrollItems.map(function () {
                if ($(this).offset().top < (fromTop + 5))
                    return this;
            });
            // Get the id of the current element
            cur = cur[cur.length - 1];
            var id = cur && cur.length ? cur[0].id : "";

            menuItems.filter("[href='#" + id + "']").addClass("active")

            if (lastId !== id) {
                lastId = id;
                // Set/remove active class
                menuItems
                    .removeClass("active")
                    .end().filter("[href='#" + id + "']").addClass("active");
            }
        });

    });

    function bbsm_scrollmagic($self, settings, init, tween, misc, bezier, trigger, controller){
        TweenMax.to($self, 0, init, 0);
        TweenMax.to($self, 0, {webkitFilter:"blur(" + init.blur + "px)",filter:"blur(" + init.blur+ "px)"}, 0);
        var reverse = true;
        if (typeof settings.general.reverse !== 'undefined') {
            reverse = eval(settings.general.reverse);
        }

        var duration = settings.general.duration;
        if( duration != '' ){
            if (duration.indexOf('vh')!=-1){
                duration = duration.replace('vh', '');
                duration = window.innerHeight/100 * duration;
            }
        }

        var scene = new ScrollMagic.Scene({
            triggerElement: '#' + trigger,
            duration: duration,
            offset: settings.general.offset,
            triggerHook: settings.general.triggerHook,
            reverse: reverse,
            tweenChanges: true
        }).setTween($self, settings.ease.duration, tween);

        if (typeof bezier != undefined && bezier.length > 0) {
            scene.setTween($self, settings.ease.duration, {
                css: {
                    bezier: {
                        curviness: 1.25,
                        //autoRotate: true,
                        values: bezier
                    }
                },
                ease: eval(settings.ease.ease)
            });
        }

        if (typeof settings.general.pin !== 'undefined' && settings.general.pin == 'on') {
            var pushFollowers = true;
            if (typeof settings.general.pushFollowers !== 'undefined') {
                pushFollowers = eval(settings.general.pushFollowers);
            }
            scene.setPin($self[0], {pushFollowers: pushFollowers});
        }

        if (typeof settings.class.classToggleEnable !== 'undefined' && settings.class.classToggleEnable == 'on') {
            $self.addClass('animated');
            if (typeof settings.class.customClassCSS !== 'undefined' && settings.class.classCSS == 'custom') {
                scene.setClassToggle($self[0], settings.class.customClassCSS);
            } else {
                scene.setClassToggle($self[0], settings.class.classCSS);
            }
        }
        scene.addTo(controller);

        
        $(window).load(function() {
            if ($self.find('path').length > 0 && typeof misc !== 'undefined' && typeof misc.drawSVG !== 'undefined' && misc.drawSVG == 'on') {
                var lineLength = $self.find('path')[0].getTotalLength();
                $self.find('path').css("stroke-dasharray", lineLength);
                $self.find('path').css("stroke-dashoffset", lineLength);
                var tween_svg = new TimelineMax().add(TweenMax.to($self.find('path'), settings.ease.duration, {
                    strokeDashoffset: 0,
                    ease: Linear.easeNone
                }));
                var scene_svg = new ScrollMagic.Scene({
                    triggerElement: '#' + trigger,
                    triggerHook: settings.general.triggerHook,
                    duration: settings.general.duration,
                    offset: settings.general.offset,
                    reverse: reverse,
                    tweenChanges: true
                }).setTween(tween_svg);
                scene_svg.addTo(controller);
            }
        });
        
        if (typeof misc !== 'undefined' && (typeof misc.imageSequence == 'undefined' || misc.imageSequence == 'on')) {
            if ($self.find('.bbsm-imagesequence').length > 0) {
                var repeat, images, obj;
                if(typeof misc.imageSequenceRepeat == 'undefined') {
                    repeat = 0;
                } else {
                    repeat = misc.imageSequenceRepeat;
                }
                images = $self.find('.bbsm-imagesequence').data('bbsm-imagesequence');
                $(images).preload();

                obj = {
                    curImg: 0
                };
                // create tween
                var tween_imagesequence = TweenMax.to(obj, 0.5, {
                    curImg: images.length - 1, // animate propery curImg to number of images
                    roundProps: "curImg", // only integers so it can be used as an array index
                    repeat: repeat, // repeat 0 times
                    immediateRender: true, // load first image automatically
                    ease: Linear.easeNone, // show every image the same ammount of time
                    onUpdate: function() {
                        $self.find('.bbsm-imagesequence img').attr("src", images[obj.curImg]); // set the image source
                        $self.find('.bbsm-imagesequence img').attr("srcset", images[obj.curImg]); // set the image source
                        $self.find('.bbsm-imagesequence source').attr("srcset", images[obj.curImg]); // set the image source
                    }
                });

                var duration = settings.general.duration;
                if( duration != '' ){
                    if (duration.indexOf('vh')!=-1){
                        duration = duration.replace('vh', '');
                        duration = window.innerHeight/100 * duration;
                    }
                }

                var scene_imagesequence = new ScrollMagic.Scene({
                    triggerElement: '#' + trigger,
                    triggerHook: settings.general.triggerHook,
                    duration: duration,
                    offset: settings.general.offset,
                    reverse: reverse,
                    tweenChanges: true
                }).setTween(tween_imagesequence);
                scene_imagesequence.addTo(controller);

            }
        }

        if ((null!=init.blur&& 0!=init.blur)||(null!=tween.blur && 0!=tween.blur)) {
            var scene_svg = new ScrollMagic.Scene({
                triggerElement: '#' + trigger,
                triggerHook: settings.general.triggerHook,
                duration: settings.general.duration,
                offset: settings.general.offset,
                reverse: reverse,
                tweenChanges: true
            });
            var blurElement = {a:init.blur!=null?init.blur*1:0};
            scene_svg.setTween( TweenMax.to(blurElement, tween.delay!=null&&tween.delay!=""?tween.delay:1, {a:tween.blur!=null?tween.blur*1:0, onUpdate:applyBlur}));
            function applyBlur()
            {
                TweenMax.set($self, {webkitFilter:"blur(" + blurElement.a + "px)",filter:"blur(" + blurElement.a + "px)"});  
            };
            scene_svg.addTo(controller);
        }
    }
    
})(jQuery);