/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    if (!window.SDK) {
        window.SDK = {};
    }
    window.SDK.invite = {
        generateNewInviteLink: function () {
            if (!window.SDK.user.isAdmin()) {
                return false;
            }
            return window.SDK.api.get('/invite/new')
                .then(function (response) {
                    console.log(response);
                    return response.link ? response.link : null;
                });
        }
    };
})(jQuery);