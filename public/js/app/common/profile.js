'use strict';

export {Profile};

function Profile(dic) {
    this._dic = dic;
    this._profileSetter = dic.get('ProfileSetter')();
    this._propertyHelper = dic.get('PropertyHelper')();
    let profileHandlers = dic.get('ProfileHandlers')(dic);
    profileHandlers.setHandlers();
}

Profile.prototype.setUserData = function () {
    let sessionModel = this._dic.get('SessionModel')();
    let userModel = sessionModel.get('_user');
    console.log('user model', userModel);
    let userData = userModel.getAllProperties();
    userData = this._propertyHelper.correctPropertyList(userData);
    console.log('profile data', userData);
    this._profileSetter.setProfileData(userData);
};

Profile.prototype.dropUserData = function () {
    this._profileSetter.dropUserData();
};

