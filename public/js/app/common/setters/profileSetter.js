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

ProfileSetter.prototype.switchToForm = function (userData) {
    const PROFILE_FORM = this._createProfileForm(userData);
    $('#userDataList').remove();
    $('.userProfileSection').append(PROFILE_FORM);
    this._setProfileFormStyles();
};

ProfileSetter.prototype._createProfileForm = function (userData) {
    let form = $('<form>').attr({
        class: "form-horizontal profileForm",
        role: "form"
    });
    console.log('data on render form', userData);
    for (let key in userData) {
        let formSection = $('<div>');
        let id = this._stringEditorHelper.toUpperCaseFirstWord(key);
        let label = $('<label>').attr({
            for: `profile${id}Input`,
        }).text(key);
        let input = $('<input>').attr({
            type: "email",
            class: "form-control",
            id: id,
            value: userData[key]
        });
        $(form).append(label);
        $(form).append(input);
    }

    return form;
};

ProfileSetter.prototype._setProfileFormStyles = function () {
    $('#uploadAvatarA').attr("style", "float: none !important");
    $('#uploadAvatarA').css({
        clear: "both",
        "margin-left": "33%",
        display: "block"
    });
    $('.profileForm label').css({
        "margin-left": "25%"
    });
    $('.profileForm input').css({
        "margin-left": "25%",
        "width": "50%"
    })
};