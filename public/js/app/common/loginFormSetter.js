/**
 * Created by honey on 31/10/17.
 */

'use strict';

export {LoginFormSetter};

function LoginFormSetter() {

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

LoginFormSetter.prototype.cleanForm = function() {

};