/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    if (!window.SDK) {
        window.SDK = {};
    }
    window.SDK.event = {
        getList: function (start, end) {
            return window.SDK.api.get('/event', {start: start, end: end});
        },

        delete: function (id) {
            return window.SDK.api.post('/event/delete', {id: id});
        },

        updateDates: function (id, start, end) {
            return window.SDK.api.post('/event/update-dates', {id: id, start: start, end: end})
        }
    };
})(jQuery);