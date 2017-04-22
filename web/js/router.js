/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';


    window.router = {
        contentSelector: '#content',

        login: function () {
            $.ajax({
                url: '/site/login',
                success: function (response) {
                    $(window.router.contentSelector).html(response);
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
                    $('#calendar').fullCalendar();
                }
            });
        }
    };

})(jQuery);