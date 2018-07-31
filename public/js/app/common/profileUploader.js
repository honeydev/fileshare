'use strict';

export {ProfileUploader};

function ProfileUploader(dic) {
    this._dic = dic;
    this._ajax = dic.get('Ajax')(dic);
    this._sessionModel = dic.get('SessionModel')();
    // console.log("session model", this._sessionModel);
}
/**
 * @param {object} key-value object with keys "avatar" or "userData"
 * @return {void}
 */
ProfileUploader.prototype.upload = function (profileData) {

    console.log('praofile data', profileData);
    const token = this._sessionModel.get('_user').get('_token');

    if (profileData.hasOwnProperty('avatar')) {
        const AVATAR = profileData.avatar;

        this._ajax.sendFile({
            data: {avatar: AVATAR},
            url: location.host + "/uploadavatar.file",
            responseHandler: this._avatarHandler.bind(this),
            headers: {
                "Authorization": `Bearer ${token}`
            }
        });
    }

    if (profileData.hasOwnProperty('userData')) {
        profileData.userData.targetProfileId = this._sessionModel.get('_user').get('_id');
        console.log(profileData.userData);
        this._ajax.sendJSON({
            url: location.host + "/profile.form",
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
    if (response.status === "success") {
        user.set("_avatarUri", response.avatar.uri);
        session.setAuthorizedUserSession(user);
        let profile = this._dic.get("Profile")(this._dic);
        profile.switchToProfile();
        console.log(this._sessionModel.get("_user"))
    } else if (response.status === "failed") {
        console.log(response);
    }
};

ProfileUploader.prototype._userDataHandler = function (response) {
    console.log(this);
    let profile = this._dic.get("Profile")(this._dic);
    let user = this._dic.get("User")(this._dic);
    let session = this._dic.get("Session");
    if (response.status === "success") {
        user.initNewUser(response.user);
        session.setAuthorizedUserSession(user);
        profile.switchToProfile();
    } else if (response.status === "failed") {

    } else {
        throw new Error(`Invalid response status ${response.status}`);
    }
};
