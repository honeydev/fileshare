'use strict';

export {ProfileFailedStatmentSetter};


function ProfileFailedStatmentSetter(dic) {
    this._errorType;
	this._profileErrorSetter = dic.get('ProfileErrorSetter')();
}

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
    if (this._errorType === "invalid_avatar") {
        //just remove error message
    } else if (this._errorType === "invalid_email") {
        this._clearEmailError();
    } else if (this._errorType === "invalid_name") {
        this._clearNameError();
    } else if (this._errorType === "invalid_passwords") {
        this._clearCurrentPasswordError();
        this._clearNewPasswordError();
        this._clearNewPasswordRepeat();
    } else if (this._errorType === "passwords_not_equal") {
        this._clearNewPasswordError();
        this._clearNewPasswordRepeat();
    }  else {
        throw new Error(`Invalid error type ${this._errorType}`);
    }
    this._profileErrorSetter.removeMessage();
};

ProfileFailedStatmentSetter.prototype._setEmailError = function () {
    $('#profileEmailGroup').addClass('has-error has-feedback');

};

ProfileFailedStatmentSetter.prototype._clearEmailError = function () {
    $('#profileEmailGroup').removeClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNameError = function () {
    $('#profileNameGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._clearNameError = function () {
    $('#profileNameGroup').removeClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setCurrentPasswordError = function () {
    $('#profileCurrentPasswordGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._clearCurrentPasswordError = function () {
    $('#profileCurrentPasswordGroup').removeClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNewPassowrdError = function () {
    $('#profileNewPasswordGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._clearNewPasswordError = function () {
    $('#profileNewPasswordGroup').removeClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._setNewPasswordRepeatError = function () {
    $('#repeatNewPasswordGroup').addClass('has-error has-feedback');
};

ProfileFailedStatmentSetter.prototype._clearNewPasswordRepeat = function () {
    $('#repeatNewPasswordGroup').removeClass('has-error has-feedback');
};
