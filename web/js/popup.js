/**
 * Created by lindal on 23.04.17.
 */
(function ($) {
    'use strict';

    window.popup = {
        showNewEventPopup: function (date) {
            $.ajax({
                url: '/site/new-event-form',
                data: {date_start: date},
                success: function (response) {
                    $('#popup-content').html(response);
                    $('#popup').dialog('open');
                }
            });
        }
    };
})(jQuery);