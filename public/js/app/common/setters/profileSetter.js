'use strict';

export {ProfileSetter};

function ProfileSetter() {

}
/**
 * @param {object} userData
 * @return {void}
 */
ProfileSetter.prototype.setProfileData = function (userData) {
    this._setProfileTitle(userData);
    this._setUserData(userData);
    this._setAvatar(userData);
};

/**
 * @param {object} userData
 * @return {void}
 */
ProfileSetter.prototype._setProfileTitle = function (userData) {
    if (userData['name'] !== null && userData['email'] !== undefined) {
        $('#profileTitle').text(`Profile ${userData['name']}`);
    } else {
        $('#profileTitle').text(`Profile ${userData['email']}`);
    }
};
/** 
 * @param {object} userData
 * @return {void}
 */
ProfileSetter.prototype._setUserData = function (userData) {

   $('#userDataList').append(`<ul>email: ${userData['email']}</ul>`);
    if (userData.hasOwnProperty('name')) {
        $('#userDataList').append(`<ul>name: ${userData['name']}</ul>`);
    }
};

ProfileSetter.prototype._setAvatar = function (userData) {


};

ProfileSetter.prototype.setHiddenProfileStatment = function () {

};