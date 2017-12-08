'use strict';

export {User};

function User(dic) {
    this._userModel;
    this._session = dic.get('Session')(dic);
    this._localStorage = dic.get('LocalStorage')(dic);
    this._userSetter = dic.get('ProfileSetter')();
    this._dic = dic;
}
/** @return void */
User.prototype.showUser = function () {
    let sessionModel = this._localStorage.createObjectFromStorage('SessionModel');
    console.log('session model', sessionModel);
    let userModel = sessionModel.get('_user');
    console.log('user model', userModel);
    //const USER_DATA = userModel.getAllProperties();
    //this._userSetter.setShowProfileStatment(USER_DATA);
};
/** @return void */
User.prototype.initNewUser = function (userData) {
    this._createUser(userData);
    this._setUserVars(userData);
    this._session.setAuthorizedUserSession(this._userModel);
    console.log('created user', this._userModel);
};
/** @return void */
User.prototype._createUser = function (userData) {
    if (userData['accessLvl'] == 1) {
        this._userModel = this._dic.get('RegularUserModel')();
        console.log('create regular user', this._userModel);
    } else if (userData['accessLvl'] == 2) {
        this._userModel = this._dic.get('AdminUserModel')();
    } else {
        throw new Error(`Invalid accessLvl value ${userData['accessLvl']}`);
    }
};
/** @return void */
User.prototype._setUserVars = function (userData) {
    for (let propertyName in userData) {
        let propertyInModel = '_' + propertyName;
        if (this._userModel.hasOwnProperty(propertyInModel)) {
            this._userModel.set(propertyInModel, userData[propertyName]);
        }
    }
};
