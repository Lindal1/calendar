/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    $(document).on('submit', '#login-form', function () {
        var username = $('#loginform-username').val();
        var password = $('#loginform-password').val();
        window.SDK.user.login(username, password)
            .then(function () {
                window.router.calendar();
            }, function (error) {
                alert(error);
            });
        return false;
    });

})(jQuery);