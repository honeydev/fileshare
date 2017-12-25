'use strict';

export {Profile};

function Profile(dic) {
    this._dic = dic;
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._propertyHelper = dic.get('PropertyHelper')();
    this._profileFormSetter = dic.get('ProfileFormSetter')();
}

Profile.prototype.setUserData = function () {
    let userData = this._getUserData();
    console.log('profile data', userData);
    this._profileSetter.setProfileData(userData);
    this._userData = userData;
    console.log('user data set in class', this._userData);
};

Profile.prototype._getUserData = function () {
    let sessionModel = this._dic.get('SessionModel')();
    let userModel = sessionModel.get('_user');
    let userData = userModel.getAllProperties();
    userData = this._propertyHelper.correctPropertyList(userData);
    return userData;
}

Profile.prototype._filtrateUserDataForProfile = function (userData) {
    let sorted = {};
    let allowKeys = ['email', 'name'];
    allowKeys.forEach((key) => {
        sorted[key] = userData[key];
    });
    return sorted;
};

Profile.prototype.dropUserData = function () {
    this._profileSetter.dropUserData();
};

Profile.prototype.uploadAvatar = function (image) {
    let fileReader = new FileReader();
    fileReader.onloadend = function () {
        this._profileSetter.setPreview(fileReader.result);
    }.bind(this);
    fileReader.readAsDataURL(image);
};

Profile.prototype.switchToForm = function () {
    let userData = this._filtrateUserDataForProfile(this._getUserData());
    this._profileFormSetter.switchToForm(userData);
}

Profile.prototype.switchToProfile = function () {

};