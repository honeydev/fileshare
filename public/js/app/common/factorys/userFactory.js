'use strict';

export {UserFactory};

function UserFactory(dic) {
    this._dic = dic;
    this._user;
}

UserFactory.prototype.create = function (userData) {
    if (userData['accessLvl'] === 0) {
        this._user = dic.get('GuestModel')();
    } else if (userData['accessLvl'] === 1) {
        this._user = dic.get('RegularUserModel')();
    } else if (userData['accessLvl'] === 2) {
        this._user = dic.get('AdminUserModel')();
    } else {
        throw new Error(`Incorrect usser accessLvl ${userData['accessLvl']}`);
    }
    this._setProperties(userData);
    return this._user;
};

UserFactory.prototype._setProperties = function (userData) {
    for (let property in userData) {
        if (property.slice(0, 1) === "_") {
            this._user.set(property, userData[property]);
        } else {
            let protectedProperty = "_" + property;
            this._user.set(protectedProperty, userData[property]);
        }
    }
}