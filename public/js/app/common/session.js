'use strict';

export {Session};

function Session(dic) {
    this._sessionModel;
    this._dic = dic;
}

/** @return void */
Session.prototype.start = function () {
    
    let savedSession = localStorage.getItem('SessionModel');

    if (savedSession != undefined && savedSession != "undefined" && savedSession != null) {
        this._sessionModel = savedSession;
    } else {
        this._sessionModel = this._dic.get('SessionModel')();
        this._setGuestSession();
    }
};

/** @return void */
Session.prototype._setGuestSession = function () {
    this._sessionModel.set('_authorizeStatus', false);
    this._sessionModel.set('_accessLvl', 0);
    this._sessionModel.set('_user', this._dic.get('GuestModel'));
    localStorage.setItem('SessionModel', this._sessionModel);
};
/**
 * @param {object} user [description]
 * @return {void}
 */
Session.prototype.setAuthorizedUserSession = function (user) {
    this._sessionModel = this._dic.get('SessionModel')();
    this._sessionModel.set('_authorizeStatus', true);
    this._sessionModel.set('_accessLvl', user.get('_accessLvl'));
    this._sessionModel.set('_user', user);
    localStorage.setItem('SessionModel', JSON.stringify(this._sessionModel));
};