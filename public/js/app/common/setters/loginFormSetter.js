'use strict';

export {LoginFormSetter};

function LoginFormSetter(dic) {
    this._authorizedStatmentSetter = dic.get('AuthorizedStatmentSetter')();
}

LoginFormSetter.prototype.setFailedAuthorizeStatment = function (errorType) {
    if (errorType === "invalid_data") {
        this._setErrorMessage('Invalid email or password');
        this._setEmailError();
        this._setPasswordError();
    } else if (errorType === "user_not_exist") {
        this._setErrorMessage('User not exist');
        this._setEmailError();
    } else if (errorType === 'password_error') {
        this._setErrorMessage('Invalid password format');
        this._setPasswordError();
    } else if (errorType === 'email_error') {
        this._setErrorMessage('Invalid email format');
        this._setEmailError();
    } else {
        throw new Error(`Invalid error type ${errorType}`);
    }
};

LoginFormSetter.prototype.clearAuthorizeFailedStatment = function () {
    this._clearErrorMessage();
    this._clearEmailError();
    this._clearPasswordError();
    //this._clearInputs();
};

LoginFormSetter.prototype._setErrorMessage = function (errorMessage) {
    $('#loginModalBody').prepend(`
        <div id="loginFormAlert" class="alert alert-danger">${errorMessage}</div>
        `);
};

LoginFormSetter.prototype._clearErrorMessage = function () {
    $("#loginFormAlert").remove();

};

LoginFormSetter.prototype._setEmailError = function () {
    $('#loginEmailGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype._clearEmailError = function () {
    $('#loginEmailGroup').removeClass('has-error has-feedback');
};

LoginFormSetter.prototype._setPasswordError = function () {
    $('#loginPasswordGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype._clearPasswordError = function () {
    $('#loginPasswordGroup').removeClass('has-error has-feedback');
};

LoginFormSetter.prototype.deleteErrorsClass = function () {
    $('#loginModal .has-error.has-feedback').
        removeClass('has-error has-feedback');
};

LoginFormSetter.prototype.setAuthorizedStatment = function () {
    $('#loginModal').modal('hide');
    this._authorizedStatmentSetter.setAuthorized();
};
