'use strict';

export {Profile};

import {ImageTypeError} from './errors/imageTypeError';

function Profile(dic) {
    this._dic = dic;
    this._logger = dic.get('Logger')(dic);
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._propertyHelper = dic.get('PropertyHelper')();
    this._profileFormSetter = dic.get('ProfileFormSetter')();
    this._imageValidator = dic.get('ImageValidator')();
    this._profileErrorSetter = dic.get('ProfileErrorSetter')();
    this._profileButtonSetters = dic.get('ProfileButtonSetter')();
    this._profileUploader = dic.get('ProfileUploader')(dic);
}
/**
 * @return void
 */
Profile.prototype.setUserData = function () {
    let userData = this._getUserData();
    this._profileSetter.setProfileData(userData);
    this._userData = userData;
    let profileHandlers = dic.get('ProfileHandlers')(dic);
    profileHandlers.setHandlers();
};
/**
 * @param {object} image File API object
 * @return {void}
 */
Profile.prototype.setAvatarPreview = function (image) {
    try {
        this._imageValidator.validate(image);
        let fileReader = new FileReader();

        fileReader.onloadend = function () {
            this._profileSetter.setAvatarPreview(fileReader.result);
        }.bind(this);
        
        fileReader.readAsDataURL(image);
        this._profileButtonSetters.haveChanges();
    } catch (Error) {
        if (Error instanceof ImageTypeError) {
            this._logger.log(Error.message);
            this._profileErrorSetter.setError(`Invalid image ${image.name} file type`);
        }
    }
};
/**
 * @return {void}
 */
Profile.prototype.switchToForm = function () {
    let userData = this._filtrateUserDataForProfile(this._getUserData());
    this._profileFormSetter.switchToForm(userData);
    this._profileButtonSetters.haveChanges();
}
/**
 * @return {void}
 */
Profile.prototype.switchToProfile = function () {
    let userData = this._getUserData();
    let profileHandlers = dic.get('ProfileHandlers')(dic);
    this._profileFormSetter.removeForm();
    this._profileSetter.swithToProfile(userData);
    profileHandlers.setEditDataIcons();
    this._profileButtonSetters.dontHaveChanges();
};
/**
 * @return {void}
 */
Profile.prototype.applyChanges = function () {
    let userData = this._getUserData();
    this._profileUploader.upload(userData);
};

/**
 * @return {object} [userData]
 */
Profile.prototype._getUserData = function () {
    let sessionModel = this._dic.get('SessionModel')();
    let userModel = sessionModel.get('_user');
    let userData = userModel.getAllProperties();
    userData = this._propertyHelper.correctPropertyList(userData);
    return userData;
};
/**
 * @param  {object} userData
 * @return {object}
 */
Profile.prototype._filtrateUserDataForProfile = function (userData) {
    let sorted = {};
    let allowKeys = ['email', 'name'];
    allowKeys.forEach((key) => {
        sorted[key] = userData[key];
    });
    return sorted;
};