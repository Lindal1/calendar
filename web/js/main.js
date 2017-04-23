/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    function init() {
        var code = findGetParameter('code');
        if (code) {
            window.router.register()
                .then(function () {
                    $('#registerform-code').val(code);
                });
        }
        else {
            window.router.calendar();
        }
    }

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }

    $(document).on('ready', init);

    $(document).on('click', '.js-logout', function () {
        window.SDK.user.logout();
        window.router.login();
        return false;
    });


})(jQuery);