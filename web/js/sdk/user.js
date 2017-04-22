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
            console.log(this.getFromStorage());
            return this.logged;
        },
        logged: false,
        data: {},
        storage: sessionStorage,
        storageParam: 'userData',

        login: function (username, password) {
            return (new Promise(function (resolve, reject) {
                return $.ajax({
                    url: '/user/login',
                    data: {username: username, password: password},
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                        window.SDK.user.data = response;
                        window.SDK.user.saveInStorage(response);
                        window.SDK.user.logged = true;
                        resolve();
                    },
                    error: function (error) {
                        console.log(error);
                        reject(error);
                    }
                });
            }));
        },

        register: function (username, password, code) {
            return (new Promise(function (resolve, reject) {
                return $.ajax({
                    url: '/user/register',
                    data: {username: username, password: password, code: code},
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                        window.SDK.user.data = response;
                        window.SDK.user.saveInStorage(response);
                        window.SDK.user.logged = true;
                        resolve();
                    },
                    error: function (error) {
                        console.log(error);
                        reject();
                    }
                });
            }));
        },

        logout: function () {
            this.logged = false;
            this.data = {};
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
        }
    };

})(jQuery);