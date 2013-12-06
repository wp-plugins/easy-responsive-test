/*
 jResize v1.0.0
 by Todd Motto: http://www.toddmotto.com
 Latest version: https://github.com/toddmotto/jResize

 Responsive development plugin for resizing the content within one window
 */


;(function ($) {

    $.jResize = function (options) {

        // jResize default options for customisation, ViewPort size, Background Color and Font Color
        $.jResize.defaults = {
            viewPortSizes   : ["320-400", "480px", "540px", "600px", "768px", "960px", "1024px", "1280px"],
            backgroundColor : '444',
            fontColor       : 'FFF'
        }

        options = $.extend({}, $.jResize.defaults, options);

        // Variables
        var resizer        = jQuery('.viewports');
        resizer.css({'background':'#'
            + options.backgroundColor,'color':'#' + options.fontColor });
        jQuery('.jbar-down-toggle').css({'background':'#'
            + options.backgroundColor})
        var viewPortWidths = options.viewPortSizes;


        // Loop through the array, using the each to dynamically generate our ViewPort lists
        $.each(viewPortWidths, function (go, className) {
            var sizes=className.split('-')

            $('.viewlist').append($('<li class="' + className + '"' + '>' + sizes[0]+' x '+sizes[1] + '</li>'));
            $('.' + className + '').click(function () {
                var height=$('#resizer').height();
                console.log(sizes[1])
                $('#resizer').animate({
                    width: '' + sizes[0] + 'px',
                    height:'' + sizes[1] + 'px'
                }, 300);
            });
        });

        // Prepend our Reset button
        $('.viewlist').prepend('<li class="reset">Reset</li>');
        jQuery('.viewlist').tabdrop();
        // Slidedown the viewport navigation and animate the resizer
        var height = $('.viewports').outerHeight();
        $('.viewports').hide().slideDown('300');
console.log(height)

        $('#resizer').css({margin: '0 auto'}).animate({marginTop : height});

        // Allow for Reset
        $('.reset').click(function () {
            $('#resizer').css({
                width: 'auto'
            });
        });

    };

})(jQuery);

!function( $ ) {

    var WinReszier = (function(){
        var registered = [];
        var inited = false;
        var timer;
        var resize = function(ev) {
            clearTimeout(timer);
            timer = setTimeout(notify, 100);
        };
        var notify = function() {
            for(var i=0, cnt=registered.length; i<cnt; i++) {
                registered[i].apply();
            }
        };
        return {
            register: function(fn) {
                registered.push(fn);
                if (inited === false) {
                    $(window).bind('resize', resize);
                    inited = true;
                }
            },
            unregister: function(fn) {
                for(var i=0, cnt=registered.length; i<cnt; i++) {
                    if (registered[i] == fn) {
                        delete registered[i];
                        break;
                    }
                }
            }
        }
    }());

    var TabDrop = function(element, options) {
        this.element = $(element);
        this.dropdown = $('<li class="ert_custom_menu tabdrop"><ul class="ert_dropdown"></ul></li>')
            .prependTo(this.element);
        if (this.element.parent().is('.tabs-below')) {
            this.dropdown.addClass('dropup');
        }

        WinReszier.register($.proxy(this.layout, this));
        this.layout();

    };

    TabDrop.prototype = {
        constructor: TabDrop,

        layout: function() {
            var collection = [];
            this.dropdown.removeClass('hide');
            this.element
                .append(this.dropdown.find('li'))
                .find('>li')
                .not('.tabdrop')
                .each(function(){
                    if(this.offsetTop > 0) {
                        collection.push(this);
                    }
                });
            if (collection.length > 0) {
                collection = $(collection);
                this.dropdown
                    .find('ul')
                    .empty()
                    .append(collection);

            } else {
                this.dropdown.addClass('hide');
            }
            construct_menu();
        }
    }

    $.fn.tabdrop = function ( option ) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('tabdrop'),
                options = typeof option === 'object' && option;
            if (!data)  {
                $this.data('tabdrop', (data = new TabDrop(this, $.extend({}, $.fn.tabdrop.defaults,options))));
            }
            if (typeof option == 'string') {
                data[option]();
            }
        })
    };



    $.fn.tabdrop.Constructor = TabDrop;

}( window.jQuery );
(function() {


})();
function construct_menu(){
    jQuery('.ert-res-menu').remove();
    var $menu = jQuery('ul.ert_dropdown')
if($menu.find('li').length){
    var    optionsList = '<option value="" selected>Sizes...</option>';
    $menu.find('li').each(function() {
        var $this   = jQuery(this),
            $anchor = $this;
        optionsList += '<option class="' + $anchor.attr('class') +'" value="' + $anchor.attr('class') + '">'+ $this.text() + '</option>';
    }).end()
        .after('<select class="ert-res-menu">' + optionsList + '</select>');
    jQuery('.ert-res-menu').on('change', function() {
      var val=jQuery(this).val();
        if(val){
        jQuery('.'+val).trigger( "click" );
        }
    });
}
}


