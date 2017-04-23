/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';


    window.router = {
        contentSelector: '#content',

        login: function () {
            $.ajax({
                url: '/user/login',
                success: function (response) {
                    $(window.router.contentSelector).html(response.content);
                }
            });
        },

        calendar: function () {
            if (!window.SDK.user.isLogged()) {
                return this.login();
            }
            $.ajax({
                url: '/site/calendar',
                success: function (response) {
                    $(window.router.contentSelector).html(response);
                    window.calendar.renderCalendar();
                }
            });
        }
    };

})(jQuery);