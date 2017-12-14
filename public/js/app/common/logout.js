'use strict';

export {Logout};

function Logout(dic) {
    this._ajax = dic.get('Ajax')(dic);
}

Logout.prototype.logout = function (id) {

};