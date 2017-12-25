'use strict';

export {ProfileFormSetter};

function ProfileFormSetter() {
    this._stringEditorHelper = dic.get('StringEditorHelper')();
}

ProfileFormSetter.prototype.switchToForm = function (userData) {
    const PROFILE_FORM = this._createProfileForm(userData);
    $('#userDataList').remove();
    $('.userProfileSection').append(PROFILE_FORM);
    this._setProfileFormStyles();
};

ProfileFormSetter.prototype._createProfileForm = function (userData) {
    let form = $('<form>').attr({
        class: "form-horizontal",
        role: "form"
    });    
    form = this._addUserDataFields(form, userData);
    form = this._addPasswordFields(form);
    return form;
};

ProfileFormSetter.prototype._addUserDataFields = function (form, userData) {
    for (let key in userData) {
        let id = this._stringEditorHelper.toUpperCaseFirstWord(key);
        let label = $('<label>').attr({
            for: `profile${id}Input`,
            class: "profileFormLabel"
        }).text(key);
        let input = $('<input>').attr({
            type: "email",
            class: "form-control profileFormInput",
            id: id,
            value: userData[key]
        });
        $(form).append(label);
        $(input).insertAfter(label);
    }
    return form;
};

ProfileFormSetter.prototype._addPasswordFields = function (form) {
    let currentPasswordLabel = $('<label>').attr({
        for: "profileCurrentPasswordInpit",
        class: "profileFormLabel"
    }).text('Current password');
    let currentPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileCurrentPasswordInpit",
    });
    let newPasswordLabel = $('<label>').attr({
        for: "profilenewPasswordInpit",
        class: "profileFormLabel profileFormLabel"
    }).text('New password');
    let newPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileNewPasswordInpit",
    });
    let newPasswordRepeatLabel = $('<label>').attr({
        for: "profilenewPasswordRepeatInpit",
        class: "profileFormLabel profileFormLabel"
    }).text('Repeat new password');
    let newPasswordRepeatInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profilenewPasswordRepeatInpit",
    });
    $(form).append(currentPasswordLabel);
    $(form).append(currentPasswordInput);
    $(form).append(newPasswordLabel);
    $(form).append(newPasswordInput);
    $(form).append(newPasswordRepeatLabel);
    $(form).append(newPasswordRepeatInput);
    return form;
};

ProfileFormSetter.prototype._setProfileFormStyles = function () {
    $('#uploadAvatarA').attr("style", "float: none !important");
    $('#uploadAvatarA').css({
        clear: "both",
        "margin-left": "34%",
        display: "block"
    });
    $('.profileFormLabel, .profileFormInput').css({
        "margin-left": "22%",
        "width": "50%"
    });
    $('#cancelPorfileButton, #profileButton').css('display', 'inline');
};

ProfileFormSetter.prototype.switchToProfile = function () {

};