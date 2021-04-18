define(['uiComponent',
    'jquery',
    'Mageugenes_Cv/js/model/loader'
], function (Component, $, loader) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Mageugenes_Cv/cv'
        },

        initialize: function () {
            loader.startLoader();

            this._super();

            loader.stopLoader();

            return this;
        }
    });
});
