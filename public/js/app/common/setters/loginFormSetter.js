/**
 * Created by honey on 31/10/17.
 */

'use strict';

export {LoginFormSetter};

function LoginFormSetter(dic) {
    this._authorizedStatmentSetter = dic.get('AuthorizedStatmentSetter')();
}

LoginFormSetter.prototype.setError = function(errorMessage) {

};

LoginFormSetter.prototype.setEmailError = function() {
    $('#loginEmailGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype.setPasswordError = function() {
    $('#loginPasswordGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype.deleteErrorsClass = function() {
    $('#loginModal .has-error.has-feedback').
        removeClass('has-error has-feedback');
};

LoginFormSetter.prototype.setAuthorizedStatment = function () {
    $('#loginModal').modal('hide');
    this._authorizedStatmentSetter.setAuthorized();
};

LoginFormSetter.prototype.setFailedAuthorizeStatment = function (errorType) {
    if (errorType === "") {

    } else if (errorType === "") {

    } else {
        throw new Error(`Invalid error type ${errorType}`);
    }
};

LoginFormSetter.prototype.cleanForm = function() {

};