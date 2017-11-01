/**
 * Created by honey on 31/10/17.
 */

'use strict';

export {LoginFormSetter};

function LoginFormSetter() {

}

LoginFormSetter.prototype.setError = function(error, errorType) {
    if (errorType == 'email') {
        $('#loginEmailGroup').addClass('has-error has-feedback');
    } else if (errorType == 'password') {
        $('#loginPasswordGroup').addClass('has-error has-feedback');
    } else {
        throw new Error('Invalid error type');
    }
};

LoginFormSetter.prototype.setEmailError = function() {
    $('#loginEmailGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype.setPasswordError = function() {
    $('#loginPasswordGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype.cleanForm = function() {
    $('#loginModal .has-error.has-feedback').
        removeClass('has-error has-feedback');
};