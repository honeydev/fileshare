'use strict';

export {ProfileFailedStatmentSetter};


function ProfileFailedStatmentSetter(dic) {
    this._errorType;
	this._profileErrorSetter = dic.get('ProfileErrorSetter')();
}

/**
 * @param {string} errorType
 */
ProfileFailedStatmentSetter.prototype.setFailedStatment = function (errorType) {
    if (errorType === "invalid_avatar") {
        this._profileErrorSetter.setError('Invalid avatar image');
    } else if (errorType === "invalid_email") {
        this._profileErrorSetter.setError('Invalid new email');
        this._setEmailError();
    } else if (errorType === "invalid_name") {
        this._profileErrorSetter.setError('Invalid new name');
        this._setNameError();
    } else if (errorType === "invalid_passwords") {
        this._profileErrorSetter.setError('Invalid password value');
        this._setCurrentPasswordError();
        this._setNewPassowrdError();
        this._setNewPasswordRepeatError();
    } else if (errorType === "passwords_not_equal") {
        this._profileErrorSetter.setError('Passwords not equal');
        this._setNewPassowrdError();
        this._setNewPasswordRepeatError();
    } else {
        throw new Error(`Invalid error type ${errorType}`);
    }
    this._errorType = errorType;
};

ProfileFailedStatmentSetter.prototype.clearFailedStatment = function () {
    this._profileErrorSetter.removeMessage();
    this._clearInputs();
};

ProfileFailedStatmentSetter.prototype._clearInputs = function () {
    $.each($('#profileForm').children(), function (num, elem) {
        $(elem).removeClass('has-error has-feedback');
    });
};

ProfileFailedStatmentSetter.prototype._setEmailError = function () {
    $('#profileEmailGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNameError = function () {
    $('#profileNameGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setCurrentPasswordError = function () {
    $('#profileCurrentPasswordGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNewPassowrdError = function () {
    $('#profileNewPasswordGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNewPasswordRepeatError = function () {
    $('#repeatNewPasswordGroup').addClass('has-error has-feedback');
}
