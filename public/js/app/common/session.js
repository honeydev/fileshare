'use strict';

export {Session};

function Session(dic) {
    this._sessionModel;
    this._dic = dic;
    this._localStorage = dic.get('LocalStorage')(dic);
}

/** @return void */
Session.prototype.start = function () {
    
    let savedSession = this._localStorage.getItem('SessionModel');

    if (savedSession != undefined && savedSession != "undefined" && savedSession != null) {
        console.log('create session from storage');
        this._localStorage.createObjectFromStorage('SessionModel');
    } else {
        console.log('create guest session');
        this._createGuestSession();
    }
};

/** @return void */
Session.prototype._createGuestSession = function () {
    this._sessionModel = this._dic.get('SessionModel')();
    this._sessionModel.set('_authorizeStatus', false);
    this._sessionModel.set('_accessLvl', 0);
    this._sessionModel.set('_user', this._dic.get('GuestModel'));
    this._localStorage.setItem('SessionModel', this._sessionModel);
    console.log('create guest sess', this._sessionModel);
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
    this._localStorage.setItem('SessionModel', this._sessionModel);
};
