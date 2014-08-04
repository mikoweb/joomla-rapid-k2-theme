/**
 * @package Joomla Rapid K2 Theme
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @url http://www.vision-web.pl
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/*
 * Działa z:
 * http://masonry.desandro.com/
 */

(function ($) {
    "use strict";

    $.app.theme.ready(function (theme) {
        var timeline = $('.blogTimeLine'),
            timelineItems = timeline.find('> .items');

        // styl osi czasu
        function timeLineStyle () {
            timeline.find('.col').each(function() {
                var $this = $(this),
                    dot = $this.find('> .dot'),
                    arrow = $this.find('> article .arrow'),
                    position = $this.position();

                if (position.left>0) {
                    dot.addClass('right');
                    arrow.addClass('right');
                }
                else {
                    dot.removeClass('right');
                    arrow.removeClass('right');
                }
            });
        }

        timeline.ready(timeLineStyle);
        theme.resize(function () {
            timeLineStyle();
        });

        theme.load(function () {
            // układ osi czasu
            timelineItems.masonry({'itemSelector': '.col'});
            timeLineStyle();
        });
    });
}(jQuery));
