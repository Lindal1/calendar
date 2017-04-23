/**
 * Created by lindal on 23.04.17.
 */
(function ($) {
    'use strict';

    window.popup = {
        loadEventCreatePopup: function (date) {
            window.SDK.api.get('/event/create', {date_start: date})
                .then(function (response) {
                    window.popup.setPopupContent(response.content);
                    window.popup.open();
                });
        },

        loadEventUpdatePopup: function (id) {
            window.SDK.api.get('/event/update', {id: id})
                .then(function (response) {
                    window.popup.setPopupContent(response.content);
                    window.popup.open();
                });
        },

        loadEventViewPopup: function (id) {
            window.SDK.api.get('/event/view', {id: id})
                .then(function (response) {
                    window.popup.setPopupContent(response.content);
                    window.popup.open();
                });
        },

        getPopup: function () {
            return $('#popup');
        },

        setPopupContent: function (content) {
            this.getPopup().html(content)
        },

        close: function () {
            this.getPopup().dialog('close');
        },

        open: function () {
            this.getPopup().dialog('open');
        }
    };

    $(document).on('click', '.js-close-popup', function (){
        window.popup.close();
    });

})(jQuery);