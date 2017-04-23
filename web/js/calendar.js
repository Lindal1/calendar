/**
 * Created by lindal on 23.04.17.
 */
(function ($) {
    'use strict';

    window.calendar = {
        getCalendarSelector: function () {
            return '#calendar';
        },

        getCalendar: function () {
            return $(this.getCalendarSelector());
        },

        getParams: function () {
            return {
                events: function (start, end, timezone, callback) {
                    window.SDK.event.getList(start.format(), end.format())
                        .done(function (data) {
                            var events = [];
                            data.forEach(function (item) {
                                events.push(item);
                            });
                            callback(events);
                        });
                },
                editable: true,
                dayClick: function (date) {
                    window.popup.loadEventCreatePopup(date.format());
                },
                eventClick: function (event) {
                    window.popup.loadEventViewPopup(event.id);
                },
                eventDataTransform: function (source) {
                    var event = {
                        id: source['id'],
                        title: source['name'],
                        start: source['date_start'] + (source['time_start'] ? ' ' + source['time_start'] : ''),
                        end: source['date_end'] + (source['time_end'] ? ' ' + source['time_end'] : ''),
                        color: source['color'],
                        user_id: source['user_id']
                    };
                    return event;
                },
                eventDrop: function (event) {
                    if (!(event.user_id == window.SDK.user.getId() || window.SDK.user.isAdmin())) {
                        alert('You don`t have permission');
                        window.calendar.refresh();
                        return false;
                    }
                    window.SDK.event.updateDates(event.id, event.start.format(), event.end ? event.end.format() : null)
                        .always(function () {
                            window.calendar.refresh();
                        });
                },
                eventResize: function (event) {
                    if (!(event.user_id == window.SDK.user.getId() || window.SDK.user.isAdmin())) {
                        alert('You don`t have permission');
                        window.calendar.refresh();
                        return false;
                    }
                    window.SDK.event.updateDates(event.id, event.start.format(), event.end ? event.end.format() : null)
                        .always(function () {
                            window.calendar.refresh();
                        });
                }
            }
        },

        initCalendar: function () {
            this.getCalendar().fullCalendar(this.getParams());
        },

        refresh: function () {
            this.getCalendar().fullCalendar('refetchEvents');
        }
    };

    function saveEvent(e) {
        var form = e.target;
        window.SDK.api.post($(form).attr('action'), $(form).serialize())
            .then(function (response) {
                if (response.content) {
                    return window.popup.setPopupContent(response.content);
                }
                window.popup.close();
            })
            .always(function () {
                window.calendar.refresh();
            });
        return false;
    }

    $(document).on('submit', '#event-form', saveEvent)
        .on('click', '.js-update-event', function () {
            window.popup.loadEventUpdatePopup($(this).data('id'));
        })
        .on('click', '.js-delete-event', function () {
            window.SDK.event.delete($(this).data('id'))
                .always(function () {
                    window.calendar.refresh();
                    window.popup.close();
                });
        })
        .on('click', '.js-generate-new-invite', function () {
            window.SDK.invite.generateNewInviteLink()
                .then(function (link) {
                    console.log(link);
                    $('.js-new-link-place').html(link);
                });
        });

})(jQuery);