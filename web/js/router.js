/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';


    window.router = {
        contentSelector: '#content',

        login: function () {
            return $.ajax({
                url: '/site/login',
                success: function (response) {
                    $(window.router.contentSelector).html(response.content);
                }
            });
        },

        calendar: function () {
            if (!window.SDK.user.isLogged()) {
                return this.login();
            }
            return $.ajax({
                url: '/site/calendar',
                success: function (response) {
                    $(window.router.contentSelector).html(response);
                    window.calendar.initCalendar();
                }
            });
        },

        register: function () {
            return $.ajax({
                url: '/site/register',
                success: function (response) {
                    $(window.router.contentSelector).html(response.content);
                }
            });
        }
    };

})(jQuery);