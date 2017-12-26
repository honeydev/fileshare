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
    this.setAvatar(userData);
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
    $('#userDataList').append(`<li><label>email:</label> ${userData['email']}</li>`);
    if (userData.hasOwnProperty('name')) {
        $('#userDataList').append(`<li><label>name:</label> ${userData['name']}</li>`);
    }
};

ProfileSetter.prototype.setAvatarPreview = function (imageSource) {
    $('#uploadAvatarA img').attr('src', imageSource);
};

ProfileSetter.prototype.setErrorMessage = function (message) {
    let alert = $('<div>').attr({
        'class': 'alert alert-danger',
        'id': 'profileErrorMessage'
    }).text(message);
    $("#profileModalBody").prepend(alert);
    setTimeout(() => {
        $(alert).remove();
    }, 4000);
}

ProfileSetter.prototype.setAvatar = function (userData) {
    if ($('#profileAvatar').length) {
        $('#profileAvatar').remove();
    }
    let avatarImage = $('<img class="thumbnail media-object" id="profileAvatar" src="/img/user.png" alt="user avatar">')
    if (userData.avatarUri !== null && userData.avatarUri !== undefined) {
        $(avatarImage).attr('src', userData.avatarUri);
    }
    $('#uploadAvatarA').append(avatarImage);
};

ProfileSetter.prototype.dropUserData = function () {
    $('#userDataList').empty();
};

ProfileSetter.prototype.swithToProfile = function (userData) {
    this.setProfileData(userData);
    this.setProfileStyles();
};

ProfileSetter.prototype.setProfileStyles = function () {
    $('#uploadAvatarA').attr("style", "float: left !important");
    $('#uploadAvatarA').css({
        clear: "both",
        "margin-left": "0%",
        display: "block"
    });
    $('#cancelPorfileButton').css('display', 'none');
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