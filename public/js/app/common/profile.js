'use strict';

export {Profile};

import {ImageTypeError} from './errors/imageTypeError';
import {InvalidServerResponseError} from './errors/InvalidServerResponseError';

function Profile(dic) {
    this._dic = dic;
    this._logger = dic.get('Logger')(dic);
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._propertyHelper = dic.get('PropertyHelper')();
    this._profileFormSetter = dic.get('ProfileFormSetter')();
    this._imageValidator = dic.get('ImageValidator')();
    this._profileErrorSetter = dic.get('ProfileErrorSetter')();
    this._profileButtonSetters = dic.get('ProfileButtonSetter')();
    this._profileDataCollector = dic.get('ProfileDataCollector')(dic);
    this._profileUploader = dic.get('ProfileUploader')(dic);
    this._profileFailedStatmentSetter = dic.get('ProfileFailedStatmentSetter')(dic);
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

Profile.prototype.removeProfile = function () {
    if ($('#profileForm').length) {
        this._profileSetter.setProfileStyles();
        this._profileFormSetter.removeForm();
    } else {
        this._profileSetter.removeProfile();
    }
};
/**
 * @throws ImageTypeError
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
            this._profileErrorSetter.removeMessage('#profileErrorMessage', 4000);
        }
    }
};

Profile.prototype.switchToForm = function () {
    let userData = this._filtrateUserDataForProfile(this._getUserData());
    this._profileFormSetter.switchToForm(userData);
    this._profileButtonSetters.haveChanges();
}

Profile.prototype.switchToProfile = function () {
    let userData = this._getUserData();
    let profileHandlers = dic.get('ProfileHandlers')(dic);
    this._profileFormSetter.removeForm();
    this._profileSetter.swithToProfile(userData);
    profileHandlers.setEditDataIcons();
    this._profileButtonSetters.dontHaveChanges();
};
/**
 * @throws InvalidServerResponseError
 */
Profile.prototype.applyChanges = function () {

    let changedProfileDataReadyToSend = {};
    
    this._profileFailedStatmentSetter.clearFailedStatment();

    if ($('#avatarUploadInput').prop('files').length) {
        changedProfileDataReadyToSend.avatar = $('#avatarUploadInput').prop('files')[0];
    }

    if ($('#profileForm').length) {
        const CURRENT_USER_DATA = this._getUserData();
        changedProfileDataReadyToSend.userData = this._profileDataCollector.collect(CURRENT_USER_DATA);
    }

    try {
        this._profileUploader.upload(changedProfileDataReadyToSend);
    } catch (Error) {
        if (Error instanceof InvalidServerResponseError) {
            this._profileErrorSetter.setError(`Server error`);
        } else {
            throw Error;
        }
    }
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

Profile.prototype.applySuccessChanges = function (userData) {
    this._profileFormSetter.removeForm();
};