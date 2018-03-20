/**
 * Created by honey on 02/11/17.
 */

'use strict';

export {RegisterFormSetter};

function RegisterFormSetter() {

}
/**
 * @param {string} errorType
 */
RegisterFormSetter.prototype.setFailedRegStatment = function (errorType) {
	if (errorType === 'invalid_registration_data') {
        this._setErrorMessage('Invalid registration data');
        this._setEmailError();
        this._setPasswordError();
        this._setNameError();
	} else if (errorType === 'user_already_exist') {
        this._setErrorMessage('Users with this email already registred');
        this._setEmailError();
	} else if (errorType === 'email_error') {
        this._setErrorMessage('Invalid email');
        this._setEmailError();
    } else if (errorType === 'password_error') {
        this._setErrorMessage('Invalid password');
        this._setPasswordError();
    } else if (errorType === 'name_error') {
        this._setErrorMessage('Invalid name');
        this._setNameError();
    } else {
        throw new Error(`Invalid error type ${errorType}`);
    }
};

RegisterFormSetter.prototype.successRegistrationStatment = function () {
    $('#registerModal').modal('hide');
    $('#loginModal').modal('show');
};

RegisterFormSetter.prototype.clearFailedRegStatment = function () {
    console.log('clear failed reg statment');
    this._clearErrorMessage();
    this._clearEmailError();
    this._clearPasswordError();
    this._clearNameError();
};
/** @param {string} */
RegisterFormSetter.prototype._setErrorMessage = function (errorMessage) {
    $('#registerModalBody').prepend(`
        <div id="registerFormAlert" class="alert alert-danger">${errorMessage}</div>
        `);
};

RegisterFormSetter.prototype._clearErrorMessage = function () {
    $('#registerFormAlert').remove();
};

RegisterFormSetter.prototype._setEmailError = function () {
    $('#registerEmailGroup').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype._clearEmailError = function () {
    $('#registerEmailGroup').removeClass('has-error has-feedback');
};

RegisterFormSetter.prototype._setPasswordError = function () {
    $('#registerPasswordGroup').addClass('has-error has-feedback');
    $('#regPasswordRepeat').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype._clearPasswordError = function () {
    $('#registerPasswordGroup').removeClass('has-error has-feedback');
    $('#regPasswordRepeat').removeClass('has-error has-feedback');
};

RegisterFormSetter.prototype._setNameError = function () {
    $('#registerNameGroup').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype._clearNameError = function () {
    $('#registerNameGroup').removeClass('has-error has-feedback');
};
