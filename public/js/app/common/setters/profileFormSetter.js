'use strict';

export {ProfileFormSetter};

function ProfileFormSetter() {
    this._stringEditorHelper = dic.get('StringEditorHelper')();
}
/**
 * @param  {object} 
 * @return {[type]}
 */
ProfileFormSetter.prototype.switchToForm = function (userData) {
    const PROFILE_FORM = this._createProfileForm(userData);
    $('#userDataList').remove();
    $('.userProfileSection').append(PROFILE_FORM);
    this._setProfileFormStyles();
};
/**
 * @param  {object} userData
 * @return {object} jquery object
 */
ProfileFormSetter.prototype._createProfileForm = function (userData) {
    let form = $('<form>').attr({
        class: "form-horizontal",
        role: "form",
        id: "profileForm"
    });    
    form = this._addUserDataFields(form, userData);
    form = this._addPasswordFields(form);
    return form;
};
/**
 * @param {object} jQuery form object
 * @param {form} jQuery form object
 */
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
            id: `profile${id}Input`,
            value: userData[key]
        });
        $(form).append(label);
        $(input).insertAfter(label);
    }
    return form;
};
/**
 * @param {object} form
 */
ProfileFormSetter.prototype._addPasswordFields = function (form) {
    let currentPasswordLabel = $('<label>').attr({
        for: "profileCurrentPasswordInpit",
        class: "profileFormLabel"
    }).text('Current password');
    let currentPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileCurrentPasswordInput",
    });
    let newPasswordLabel = $('<label>').attr({
        for: "profilenewPasswordInpit",
        class: "profileFormLabel profileFormLabel"
    }).text('New password');
    let newPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileNewPasswordInput",
    });
    let newPasswordRepeatLabel = $('<label>').attr({
        for: "profilenewPasswordRepeatInpit",
        class: "profileFormLabel profileFormLabel"
    }).text('Repeat new password');
    let newPasswordRepeatInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileNewPasswordRepeatInput",
    });
    $(form).append(currentPasswordLabel);
    $(form).append(currentPasswordInput);
    $(form).append(newPasswordLabel);
    $(form).append(newPasswordInput);
    $(form).append(newPasswordRepeatLabel);
    $(form).append(newPasswordRepeatInput);
    return form;
};
/**
 * @return {void}
 */
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
};
/** @return {void} */
ProfileFormSetter.prototype.removeForm = function () {
    $('#profileForm').remove();
};  
