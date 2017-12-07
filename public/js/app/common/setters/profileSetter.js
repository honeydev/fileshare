'use strict';

export {ProfileSetter};

function ProfileSetter() {

}
/** @param array
 *  @return void
 */
ProfileSetter.prototype.setShowProfileStatment = function (userData) {
    this._setProfileTitle(userData.email, userData.name);
    this._setUserData(userData);
};
/**
 * @param {string} email
 * @param {string} name
 * @return void
 */
ProfileSetter.prototype._setProfileTitle = function (email, name) {
    if (name !== null && name !== undefined) {
        $('#profileTitle').text(`Profile ${name}`);
    } else {
        $('#profileTitle').text(`Profile ${email}`);
    }
};
/** 
 * @param object
 * 
 */
ProfileSetter.prototype._setUserData = function (userData) {
    userData.forEach((value, index) => {
        $('#userDataList').append(`<ul>${index}: ${value}</ul>`);
    });
};

ProfileSetter.prototype.setHiddenProfileStatment = function () {

};