/**
 * Created by lindal on 22.04.17.
 */
(function ($) {
    'use strict';

    if (!window.SDK) {
        window.SDK = {};
    }
    window.SDK.user = {
        isLogged: function () {
            var data = this.getFromStorage();
            return data !== null;
        },
        data: {},
        storage: sessionStorage,
        storageParam: 'userData',

        login: function (username, password) {
            return window.SDK.api.post('/user/login', {username: username, password: password})
                .then(function (response) {
                    window.SDK.user.data = response;
                    window.SDK.user.saveInStorage(response);
                    window.SDK.api.token = response['access_token'];
                    return;
                });
        },

        register: function (username, password, inviteCode) {
            return window.SDK.api.post('/site/login', {username: username, password: password, inviteCode: inviteCode})
                .then(function (response) {
                    window.SDK.user.data = response;
                    window.SDK.user.saveInStorage(response);
                    window.SDK.api.token = response['access_token'];
                    return;
                });
        },

        logout: function () {
            this.saveInStorage(null);
            window.SDK.api.token = null;
        },

        saveInStorage: function (data) {
            this.storage.setItem(this.storageParam, JSON.stringify(data));
        },

        getFromStorage: function () {
            return JSON.parse(this.storage.getItem(this.storageParam));
        },

        getData: function () {
            if (Object.keys(this.data).length === 0 && this.data.constructor === Object) {
                this.data = this.getFromStorage();
            }
            return this.data;
        },

        isAdmin: function () {
            var data = this.getFromStorage();
            return data['group'] == 1;
        },

        getId: function () {
            var data = this.getFromStorage();
            return data['id'];
        }
    };

})(jQuery);