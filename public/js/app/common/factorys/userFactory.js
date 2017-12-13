'use strict';

export {UserFactory};

function UserFactory(dic) {
    this._dic;
    this._user;
}

UserFactory.prototype.create = function (userData) {
    if (userData['accessLvl'] === 0) {
        this._user = dic.get('GuestModel')();
    } else if (userData['accessLvl'] === 1) {
        this._user = dic.get('RegularUserModel')();
    } else if (userData['accessLvl'] === 2) {
        this._user = dic.get('AdminUserModel')();
    }
    return this._user;
};
