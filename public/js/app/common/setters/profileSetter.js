'use strict';

export {ProfileSetter};

function ProfileSetter(dic) {
    this._stringEditorHelper = dic.get('StringEditorHelper')();
}
/**
 * @param {object} userData
 * @return {void}
 */
ProfileSetter.prototype.setProfileData = function (userData) {
    this._setProfileTitle(userData);
    this._setUserData(userData);
    this._setUserDataEditIcon();
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

    $('#userDataList').append(`<ul><label>email:</label> ${userData['email']}</ul>`);
    if (userData.hasOwnProperty('name')) {
        $('#userDataList').append(`<ul><label>name:</label> ${userData['name']}</ul>`);
    }
};

ProfileSetter.prototype.setAvatarPreview = function (imageSource) {
    $('#uploadAvatarA img').attr('src', imageSource);
};

ProfileSetter.prototype._setAvatar = function (userData) {

};

ProfileSetter.prototype.dropUserData = function () {
    $('#userDataList').empty();
};

ProfileSetter.prototype._setUserDataEditIcon = function () {
    $('#userDataList').children().append('<a href="#"><span class="userDataEditIcon glyphicon glyphicon-edit"></span></a>');
};

ProfileSetter.prototype.showUserDataEditIcon = function (li) {
    $(li).find(".userDataEditIcon").css('display', 'inline');
};

ProfileSetter.prototype.hideUserDataEditIcon = function (li) {
    $(li).find(".userDataEditIcon").css('display', 'none');
};