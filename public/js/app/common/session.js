'use strict';

export {Session};

function Session(dic) {
    this._sessionModel;
    this._dic = dic;
}

Session.prototype.start = function () {
    if (localStorage.setItem('SessionModel', this._sessionModel) === undefined) {
        console.log('create guest session');
        this._sessionModel = dic.get('SessionModel')();
        this._setGuestSession();
    } else {
        this._sessionModel = localStorage.setItem('SessionModel', this._sessionModel);
    }
};

Session.prototype._setGuestSession = function () {
    this._sessionModel.set('authorizeStatus', false);
    this._sessionModel.set('accessLvl', 0);
    this._sessionModel.set('user', this._dic.get('GuestModel'));
};
/**
 * @param {object} user [description]
 */
Session.prototype.setAuthorizedUserSession = function (user) {
    this._sessionModel.set('authorizeStatus', false);
    this._sessionModel.set('authorizeStatus', user.get('accessLvl'));
    this._sessionModel.set('user', user);
};