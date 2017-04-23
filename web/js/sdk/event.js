/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    if (!window.SDK) {
        window.SDK = {};
    }
    window.SDK.event = {
        getList: function () {
            return window.SDK.api.get('/events');
        },

        getOne: function (id) {
            return window.SDK.api.get('/events/' + id);
        },

        create: function (data) {
            return window.SDK.api.post('/events', data);
        },

        update: function (id, data) {
            return window.SDK.api.put('/events/' + id, data);
        },

        delete: function (id) {
            return window.SDK.api.delete('/events/' + id);
        }
    };
})(jQuery);