'use strict';

export {ProfileUploader};

import {InvalidServerResponseError} from './errors/InvalidServerResponseError';

function ProfileUploader(dic) {
    this._dic = dic;
    this._ajax = dic.get('Ajax')(dic);
    this._sessionModel = dic.get('SessionModel')();
}
/**
 * @param {object} key-value object with keys "avatar" or "userData"
 */
ProfileUploader.prototype.upload = function (profileData) {
    const TOKEN = this._sessionModel.get('_user').get('_token');

    if (profileData.hasOwnProperty('avatar')) {
        const AVATAR = profileData.avatar;
        this._ajax.sendFile({
            data: {file: AVATAR},
            url: location.host + "/api/uploadavatar.file",
            responseHandler: this._avatarHandler.bind(this),
            headers: {
                "Authorization": `Bearer ${TOKEN}`
            }
        });
    }

    if (profileData.hasOwnProperty('userData')) {
        profileData.userData.targetProfileId = this._sessionModel.get('_user').get('_id');
        this._ajax.sendJSON({
            url: location.host + "/api/profile.form",
            method: "POST",
            requestData: profileData.userData,
            responseHandler: this._userDataHandler.bind(this),
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-type": "application/json"
            }
        });
    }
};

ProfileUploader.prototype._avatarHandler = function (response) {
    let user = this._sessionModel.get("_user");
    let session = this._dic.get("Session")(dic);
    let profile = this._dic.get("Profile")(this._dic);
    if (response.status === "success") {
        user.set("_avatarUri", response.avatar.uri);
        this._sessionModel.set("_user", user);
        session.saveSession();
        profile.switchToProfile();
    } else if (response.status === "failed") {
        throw new InvalidServerResponseError("Serever Error");
    } else {
        throw new InvalidServerResponseError("Server Error");
    }
};

ProfileUploader.prototype._userDataHandler = function (response) {
    let profile = this._dic.get("Profile")(this._dic);
    let user = this._dic.get("User")(this._dic);
    if (response.status === "success") {
        user.initNewUser(response.user);
        profile.switchToProfile();
    } else if (response.status === "failed") {
        throw new InvalidServerResponseError("Server Error");
    } else {
        throw new InvalidServerResponseError("Server Error");
    }
};
