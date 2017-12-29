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
    let userDataList = $('<ul>').attr('id', 'userDataList');
    $('.userProfileSection').append(userDataList);
    $('#userDataList').append(`<li><label>Email:</label> ${userData['email']}</li>`);
    if (userData.hasOwnProperty('name')) {
        $('#userDataList').append(`<li><label>Name:</label> ${userData['name']}</li>`);
    }
};
/**
 * @param {string} imageSource
 */
ProfileSetter.prototype.setAvatarPreview = function (imageSource) {
    $('#uploadAvatarAInProfile img, #uploadAvatarAInForm img').attr('src', imageSource);
};
/**
 * @param {string} message
 */
ProfileSetter.prototype.setErrorMessage = function (message) {
    let alert = $('<div>').attr({
        'class': 'alert alert-danger',
        'id': 'profileErrorMessage'
    }).text(message);
    $("#profileModalBody").prepend(alert);
    setTimeout(() => {
        $(alert).remove();
    }, 4000);
};
/**
 * @param {[type]} userData [description]
 */
ProfileSetter.prototype._setAvatar = function (userData) {
    if ($('#profileAvatar').length) {
        $('#profileAvatar').remove();
    }
    let avatarImage = $('<img class="center-block img-thumbnail media-object" id="profileAvatar" src="/img/user.png" alt="user avatar">')
    if (userData.avatarUri !== null && userData.avatarUri !== undefined) {
        $(avatarImage).attr('src', userData.avatarUri);
    }
    $('#uploadAvatarAInProfile, #uploadAvatarAInForm').append(avatarImage);
};

ProfileSetter.prototype.removeProfile = function () {
    $('#userDataList').remove();
};    

ProfileSetter.prototype.dropUserData = function () {
    $('#userDataList').empty();
};
/**
 * @param  {object} userData key value object
 * @return {void}
 */
ProfileSetter.prototype.swithToProfile = function (userData) {
    if ($('#userDataList').length) {
        $('#userDataList').remove();
    }
    this.setProfileData(userData);
    this.setProfileStyles();
};

ProfileSetter.prototype.setProfileStyles = function () {
    $('#uploadAvatarAInForm').attr({
        "style": "float: left !important",
        "id": "uploadAvatarAInProfile"
    });
    $('#uploadAvatarInProfile').css({
        clear: "both",
        "margin-left": "0%",
    });
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