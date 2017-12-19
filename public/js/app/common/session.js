'use strict';

export {Session};

function Session(dic) {
    this._sessionModel;
    this._dic = dic;
    this._localStorage = dic.get('LocalStorage')(dic);
    this._userFactory = dic.get('UserFactory')(dic);
    this._authorizedStatmentSetter = dic.get('AuthorizedStatmentSetter')();
    this._profile = dic.get('Profile')(dic);
}

/** @return void */
Session.prototype.start = function () {
    let savedSession = this._localStorage.getItem('SessionModel');

    if (savedSession != undefined && savedSession != "null" && savedSession != null) {
        console.log('create session from storage', typeof savedSession);
        this._createSessionFromStorage(savedSession);
        this._profile.setUserData();
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
};
/**
 * @param {object} user [description]
 * @return {void}
 */
Session.prototype.setAuthorizedUserSession = function (user) {
    this._sessionModel = this._dic.get('SessionModel')();
    console.log('session after logout', this._sessionModel);
    this._sessionModel.set('_authorizeStatus', true);
    this._sessionModel.set('_accessLvl', user.get('_accessLvl'));
    this._sessionModel.set('_user', user);
    this._localStorage.setItem('SessionModel', this._sessionModel);
};
/** 
 * @param  {object} sessionData 
 * @return {void}
 */
Session.prototype._createSessionFromStorage = function (sessionData) {

    this._sessionModel = this._dic.get('SessionModel')();

    for (let property in sessionData) {
        if (property === "_user") {
            const USER_DATA = sessionData[property];
            const ACCESS_LVL = sessionData[property]['_accessLvl'];
            this._sessionModel['_user'] = this._userFactory.create(ACCESS_LVL, USER_DATA);
            console.log('factory create this user', this._sessionModel['_user']);
            continue;
        }
        this._sessionModel[property] = sessionData[property];
    }
    console.log('create from sa session', this._sessionModel);
    this._authorizedStatmentSetter.setAuthorized();
};

Session.prototype.destroySession = function () {
    //TODO test this block
    let sessionModel = this._dic.get('SessionModel')();
    sessionModel.setStatic('_sessionModel', null);
    this._localStorage.removeItem('SessionModel');
    console.log('deleted Session model');
};
