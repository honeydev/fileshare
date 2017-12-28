'use strict';

export {ProfileFormSetter};

function ProfileFormSetter() {
    this._stringEditorHelper = dic.get('StringEditorHelper')();
    this._LABEL_INDEX = 0;
    this._INPUT_INDEX = 1;
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
    let form = this._createFormElements();
    form = this._setFormProps(from);
    $(form).children()[0] = this._setEmailGroupProps(form, userData['email']);
    $(form).children()[1] = this._setNameGroupProps(form, userData);
};

ProfileFormSetter.prototype._createFormElements = function () {
    const INPUTS_NUMBER = 5;
    let form = $('<form>');

    let wrap, label, input;

    for (let i = 0; i < INPUTS_NUMBER; i++) {
        wrap = $('<div>');
        label = $('<label>');
        input = $('<input>');

        $(form).append(wrap);
        $(wrap).append(label);
        $(wrap).append(input);
    }

    return form;
}

ProfileFormSetter.prototype._setFormProps = function (form) {
    $(form).attr({
        class: "form-horizontal",
        role: "form",
        id: "profileForm"
    });
    return form;
};


ProfileFormSetter.prototype._setEmailGroupProps = function (emailGroup, email) {
    let label = $(email).children(this._LABEL_INDEX);
    let input = $(email).children(this._INPUT_INDEX);

    $(emailGroup).attr("class", "form-group");
    $(label).attr({
        class: "form-control profileFormInput",
        id: `profileEmailInput`,
        value: userData['email']
    });
};

ProfileFormSetter.prototype._setNameGroupProps = function (form) {

};

ProfileFormSetter.prototype._setCurrentPasswordGroupProps = function (form) {

};

ProfileFormSetter.prototype._setNewPasswordGroupProps = function (form) {

};

ProfileFormSetter.prototype._setNewPasswordRepeatGropuProps = function (form) {

};
/**
 * @param {object} jQuery form object
 * @param {form} jQuery form object
 */
ProfileFormSetter.prototype._addUserDataFields = function (form, userData) {
    let id, wrap, label, input;
    for (let key in userData) {
        id = this._stringEditorHelper.toUpperCaseFirstWord(key);
        wrap = $('<div class="form-group"></div>');
        label = $('<label>').attr({
            for: `profile${id}Input`,
            class: "profileFormLabel"
        }).text(key);
        input = $('<input>').attr({
            class: "form-control profileFormInput",
            id: `profile${id}Input`,
            value: userData[key]
        });

        $(form).append(wrap);
        $(wrap).append(label);
        $(input).insertAfter(label);
    }
    return form;
};


/**
 * @param {object} form
 */
ProfileFormSetter.prototype._addPasswordFields = function (form) {
    let passwordWrap = $('<div class="form-group"></div>');
    let currentPasswordLabel = $('<label>').attr({
        for: "profileCurrentPasswordInpit",
        class: "profileFormLabel"
    }).text('Current password');
    let currentPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileCurrentPasswordInput",
    });
    let newPasswordWrap = $('<div class="form-group"></div>');
    let newPasswordLabel = $('<label>').attr({
        for: "profilenewPasswordInput",
        class: "profileFormLabel profileFormLabel"
    }).text('New password');
    let newPasswordInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileNewPasswordInput",
    });
    let newPasswordRepeatWrap = $('<div class="form-group"></div>');
    let newPasswordRepeatLabel = $('<label>').attr({
        for: "profilenewPasswordRepeatInput",
        class: "profileFormLabel profileFormLabel"
    }).text('Repeat new password');
    let newPasswordRepeatInput = $('<input>').attr({
        type: "password",
        class: "form-control profileFormInput",
        id: "profileNewPasswordRepeatInput",
    });
    $(form).append(passwordWrap);
    $(passwordWrap).append(currentPasswordLabel);
    $(passwordWrap).append(currentPasswordInput);
    $(form).append(newPasswordWrap);
    $(newPasswordWrap).append(newPasswordLabel);
    $(newPasswordWrap).append(newPasswordInput);
    $(form).append(newPasswordRepeatWrap);
    $(newPasswordRepeatWrap).append(newPasswordRepeatLabel);
    $(newPasswordRepeatWrap).append(newPasswordRepeatInput);
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

/** @param {object} jQuery dom element */
ProfileFormSetter.prototype.setError = function (element) {
    $(element).parent.attr('class', 'has-error');
};
