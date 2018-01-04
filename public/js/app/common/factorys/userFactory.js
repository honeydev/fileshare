'use strict';

export {UserFactory};

function UserFactory(dic) {
    this._dic = dic;
    this._user;
}

UserFactory.prototype.create = function (accessLvl, userData) {
    if (accessLvl == 0) {
        this._user = dic.get('GuestModel')();
    } else if (accessLvl == 1) {
        this._user = dic.get('RegularUserModel')();
    } else if (accessLvl == 2) {
        this._user = dic.get('AdminModel')();
    } else {
        throw new Error(`Incorrect user accessLvl ${userData['accessLvl']}`);
    }
    this._setProperties(userData);
    return this._user;
};

UserFactory.prototype._setProperties = function (userData) {
    console.log(userData);
    for (let property in userData) {
        console.log(property);
        if (property.slice(0, 1) === "_") {
            this._user.set(property, userData[property]);
        } else {
            let protectedProperty = "_" + property;
            this._user.set(protectedProperty, userData[property]);
        }
    }
};