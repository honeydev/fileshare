'use strict';

export {ProfileUploader};


function ProfileUploader(dic) {
    this._ajax = dic.get('Ajax')(dic);
}
/**
 * @param {object} key-value object with keys "avatar" or "userData"
 * @return {void}
 */
ProfileUploader.prototype.upload = function (profileData) {

    console.log('praofile data', profileData);

    if (profileData.hasOwnProperty('avatar')) {
        this._ajax.sendFile({
            file: profileData.avatar,
            url: location.host + "/userAvatar.file",
            method: "PUT",
            responseHandler: this._avatarHandler
        });
    }

    if (profileData.hasOwnProperty('userData')) {
        console.log(profileData.userData);
        this._ajax.sendJSON({
            url: location.host + "/profile.form",
            method: "PUT",
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
