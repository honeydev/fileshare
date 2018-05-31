/**
 * Created by honey on 29/10/17.
 */
 
'use strict';

export {RegisterForm};

import {EmailValidError} from './errors/emailValidError.js';
import {PasswordValidError} from './errors/passwordValidError.js';
import {NameValidError} from './errors/nameValidError.js';


function RegisterForm(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._emailValidator = dic.get('EmailValidator')();
    this._passwordValidator = dic.get('PasswordValidator')();
    this._nameValidator = dic.get('NameValidator')();
    this._registerFormSetter = dic.get('RegisterFormSetter')();
    this._email = null;
    this._name = null;
    this._password = null;
    this._passwordRepeat = null;
}

RegisterForm.prototype.sendRegisterForm = function() {
    this._registerFormSetter.clearFailedRegStatment();
    this._setRegisterFormValues();
    this._validate();
    this._ajax.sendJSON(
        {
            "url": location.host + "/register.form",
            "requestData": {
                email: this._email,
                name: this._name,
                password: this._password,
                passwordRepeat: this._passwordRepeat,
                accessLvl: 1
            },
            "responseHandler": this._registerFormHandler.bind(this),
            "method": "POST"
        }
    );
};

RegisterForm.prototype._validate = function() {
    try {
        this._emailValidator.validate(this._email);
        this._passwordValidator.validate(this._password);
        this._passwordValidator.validate(this._passwordRepeat);
        this._passwordValidator.checkEqual(this._password, this._passwordRepeat);
        this._nameValidator.validate(this._name);
    } catch (Error) {
        this._errorStrategy(Error);
        throw 'Register form validation failed';
    }
};

RegisterForm.prototype._errorStrategy = function(Error) {
    if (Error instanceof EmailValidError) {
        this._registerFormSetter.setFailedRegStatment('email_error');
    } else if (Error instanceof PasswordValidError) {
        this._registerFormSetter.setFailedRegStatment('password_error');
    } else if (Error instanceof NameValidError) {
        this._registerFormSetter.setFailedRegStatment('name_error');
    }
};

RegisterForm.prototype._setRegisterFormValues = function() {
    this._email = $('#registerEmail').prop('value');
    this._name = $('#registerName').prop('value');
    this._password = $('#registerPassword').prop('value');
    this._passwordRepeat = $('#passwordRepeat').prop('value');
};

RegisterForm.prototype._registerFormHandler = function (response) {
    console.log(response);
    if (response.status === 'success') {
        this._registerFormSetter.successRegistrationStatment();
    } else if (response.status === 'failed') {
        this._registerFormSetter.setFailedRegStatment(response.errorType);
    } else {
        throw new Error(`Invalid response status ${response.status}`);
    }
};