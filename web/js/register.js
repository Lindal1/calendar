/**
 * Created by lindal on 24.04.17.
 */
(function ($) {
    'use strict';

    $(document).on('submit', '#register-form', function () {
        window.SDK.api.post($(this).attr('action'), $(this).serialize())
            .then(function (response) {
                if (response.content) {
                    $('#content').html(response.content);
                }
                else {
                    window.history.pushState("Home", "Home", "/");
                    window.SDK.user.data = response;
                    window.SDK.user.saveInStorage(response);
                    window.SDK.api.token = response['access_token'];
                    window.router.calendar();
                }
            });
        return false;
    });
})(jQuery);