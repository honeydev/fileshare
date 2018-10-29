'use strict';

export {Logout};

import Cookies from 'js-cookie';

function Logout(dic) {
    this._logger = dic.get('Logger')(dic);
    this._ajax = dic.get('Ajax')(dic);
    this._session = dic.get('Session')(dic);
    this._unauthorizedStatmentSetter = dic.get('UnauthorizedStatmentSetter')();
    this._profile = dic.get('Profile')(dic);
}

Logout.prototype.logout = function () {
    this._ajax.doAction({
        url: location.host + '/api/logout.action',
        responseHandler: this._handler.bind(this)
    });
};

Logout.prototype._handler = function (response) {
    if (response.status === "success") {
        this._session.destroySession();
        Cookies.remove('token');
        this._unauthorizedStatmentSetter.setUnatuhorized();
        this._profile.removeProfile();
    } else if (resposne.status === "failed") {
        this._logger.log('Failed log out');
        this._logger.log(response);
    } else {
        throw new Error(`Invalid response status ${response.status}`);
    }
};