'use strict';

export {ProfileUploader};

function ProfileUploader(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._sessionModel = dic.get('SessionModel')();
    console.log(this._sessionModel)
}
/**
 * @param {object} key-value object with keys "avatar" or "userData"
 * @return {void}
 */
ProfileUploader.prototype.upload = function (profileData) {

    console.log('praofile data', profileData);
    // profileData.userData['token'] = this._sessionModel.get('_user').get('_token');

    if (profileData.hasOwnProperty('avatar')) {
        this._ajax.sendFile({
            file: profileData.avatar,
            url: location.host + "/uploadavatar.file",
            method: "POST",
            responseHandler: this._avatarHandler
        });
    }

    if (profileData.hasOwnProperty('userData')) {
        console.log(profileData.userData);
        this._ajax.sendJSON({
            url: location.host + "/profile.form",
            method: "POST",
            requestData: profileData.userData,
            responseHandler: this._userDataHandler
        });
    }
};

ProfileUploader.prototype._avatarHandler = function (response) {
    if (response.status === "success") {
        console.log(response);
    } else if (response.status === "failed") {
        console.log(response);
    }
    console.log(response);
}.bind(this);

ProfileUploader.prototype._userDataHandler = function (response) {

    if (response.status === "success") {

    } else if (response.status === "failed") {

    } else {
        throw new Error(`Invalid response status ${response.status}`);
    }
}.bind(this);
