define([
    'jquery',
    'rjsResolver'
], function ($, resolver) {
    'use strict';

    const container = '.cv-container';

    return {
        startLoader: function () {
            $(container).trigger('processStart');
        },

        stopLoader: function (forceStop) {
            var $elem = $(container),
                stop = $elem.trigger.bind($elem, 'processStop');

            forceStop ? stop() : resolver(stop);
        }
    }
})
