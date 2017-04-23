/**
 * Created by lindal on 23.04.17.
 */
(function ($) {
    'use strict';

    window.calendar = {
        getCalendarSelector: function () {
            return '#calendar';
        },

        renderCalendar: function () {
            $(this.getCalendarSelector()).fullCalendar({
                events: function (start, end, timezone, callback) {
                    window.SDK.event.getList()
                        .then(function (data) {
                            var events = [];
                            data.forEach(function (item) {
                                events.push({
                                    id: item.id,
                                    title: item.name,
                                    start: item['date_start']
                                });
                            });
                            callback(events);
                        });
                },
                dayClick: function (date) {
                    window.popup.showNewEventPopup(date.format());
                }
            });
        }
    };

})(jQuery);