/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    $(document).on('submit', '#login-form', function () {
        window.SDK.api.post('/user/login', $(this).serialize())
            .then(function (response) {
                if (response.content) {
                    $('#content').html(response.content);
                }
                else {
                    window.SDK.user.data = response;
                    window.SDK.user.saveInStorage(response);
                    window.SDK.api.token = response['access_token'];
                    window.router.calendar();
                }
            });
        return false;
    });

})(jQuery);