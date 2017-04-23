/**
 * Created by lindal on 23.04.17.
 */
(function ($) {
    'use strict';

    if (!window.SDK) {
        window.SDK = {};
    }
    window.SDK.api = {
        token: null,

        getToken: function () {
            if (!this.token) {
                var data = window.SDK.user.getFromStorage();
                if (data && data['access_token']) {
                    this.token = data['access_token'];
                }
            }
            return this.token;
        },

        request: function (type, url, params) {
            return $.ajax({
                url: url,
                data: params,
                type: type,
                dataType: 'json',
                headers: {Authorization: 'Bearer ' + window.SDK.api.getToken()},
                error: function (error) {
                    alert(error.responseJSON.message);
                    return error;
                }
            });
        },

        get: function (url, params) {
            return this.request('get', url, params);
        },

        post: function (url, params) {
            return this.request('post', url, params);
        },

        put: function (url, params) {
            return this.request('put', url, params);
        },

        delete: function (url, params) {
            return this.request('delete', url, params);
        }
    };
})(jQuery);