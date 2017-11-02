/**
 * Created by honey on 02/11/17.
 */

'use strict';

export {RegisterFormSetter};

function RegisterFormSetter() {

}

RegisterFormSetter.prototype.setError = function(errorMessage) {

};

RegisterFormSetter.prototype.setEmailError = function() {
    $('#registerEmailGroup').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype.setPasswordError = function() {
    $('#registerPasswordGroup').addClass('has-error has-feedback');
    $('#regPasswordRepeat').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype.setNameError = function () {
    $('#registerName').addClass('has-error has-feedback');
};

RegisterFormSetter.prototype.deleteErrorsClass = function() {
    $('#registerModal .has-error.has-feedback').
        removeClass('has-error has-feedback');
};

RegisterFormSetter.prototype.cleanForm = function() {

};