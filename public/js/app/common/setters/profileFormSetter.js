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
    this.removeForm();
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
    form = this._setFormProps(form);
    this._setEmailGroupProps($(form).children()[0], userData['email']);
    this._setNameGroupProps($(form).children()[1], userData['name']);
    this._setCurrentPasswordGroupProps($(form).children()[2]);
    this._setNewPasswordGroupProps($(form).children()[3]);
    this._setNewPasswordRepeatGropuProps($(form).children()[4]);
    $('#userProfileSection').append(form);
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
    let label = $(emailGroup).children()[this._LABEL_INDEX];
    let input = $(emailGroup).children()[this._INPUT_INDEX];

    $(emailGroup).attr({
        class: "form-group",
        id: "profileEmailGroup"
        });
    $(label).attr({
        for: `profileEmailInput`,
        class: "profileFormLabel"
    }).text('Email:');
    $(input).attr({
        class: "form-control profileFormInput",
        id: `profileEmailInput`,
        value: email,
        type: "email"
    });
};

ProfileFormSetter.prototype._setNameGroupProps = function (nameGroup, name) {
    let label = $(nameGroup).children()[this._LABEL_INDEX];
    let input = $(nameGroup).children()[this._INPUT_INDEX];

    $(nameGroup).attr({
        class: "form-group",
        id: "profileNameGroup"
    });
    $(label).attr({
        for: `profileNameInput`,
        class: "profileFormLabel"
    }).text('Name:');
    $(input).attr({
        class: "form-control profileFormInput",
        id: `profileNameInput`,
        value: name,
        type: "text"
    });
};

ProfileFormSetter.prototype._setCurrentPasswordGroupProps = function (currentPasswordGroup) {
    let label = $(currentPasswordGroup).children()[this._LABEL_INDEX];
    let input = $(currentPasswordGroup).children()[this._INPUT_INDEX];

    $(currentPasswordGroup).attr({
        class: "form-group",
        id: "profileCurrentPasswordGroup"
    });
    $(label).attr({
        for: `profileCurrentPasswordInput`,
        class: "profileFormLabel"
    }).text('Current password:');
    $(input).attr({
        class: "form-control profileFormInput",
        id: `profileCurrentPasswordInput`,
        type: "password"
    });
};

ProfileFormSetter.prototype._setNewPasswordGroupProps = function (newPasswordGroup) {
    let label = $(newPasswordGroup).children()[this._LABEL_INDEX];
    let input = $(newPasswordGroup).children()[this._INPUT_INDEX];

    $(newPasswordGroup).attr({
        class: "form-group",
        id: "profileNewPasswordGroup"
    });
    $(label).attr({
        for: `profileNewPasswordInput`,
        class: "profileFormLabel"
    }).text('New password:');
    $(input).attr({
        class: "form-control profileFormInput",
        id: `profileNewPasswordInput`,
        type: "password"
    });
};

ProfileFormSetter.prototype._setNewPasswordRepeatGropuProps = function (repeatNewPasswordGroup) {
    let label = $(repeatNewPasswordGroup).children()[this._LABEL_INDEX];
    let input = $(repeatNewPasswordGroup).children()[this._INPUT_INDEX];

    $(repeatNewPasswordGroup).attr({
        class: "form-group",
        id: "repeatNewPasswordGroup"
    });
    $(label).attr({
        for: `profileNewPasswordRepeatInput`,
        class: "profileFormLabel"
    }).text('Repeat new password:');
    $(input).attr({
        class: "form-control profileFormInput",
        id: `profileNewPasswordRepeatInput`,
        type: "password"
    });
};
/**
 * @return {void}
 */
ProfileFormSetter.prototype._setProfileFormStyles = function () {
    $('#uploadAvatarAInProfile').attr("style", "float: none !important");
    $('#uploadAvatarAInProfile').attr("id", "uploadAvatarAInForm");
};


/** @return {void} */
ProfileFormSetter.prototype.removeForm = function () {
    console.log("PROFILE FORM", $('#profileForm'));
    $('#profileForm').remove();
};  

/** @param {object} jQuery dom element */
ProfileFormSetter.prototype.setError = function (element) {
    $(element).parent.attr('class', 'has-error');
};
