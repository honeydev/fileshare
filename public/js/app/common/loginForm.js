/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {LoginForm};

import {EmailValidError} from './errors/emailValidError.js';
import {PasswordValidError} from './errors/passwordValidError.js';

function LoginForm(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._emailValidator = dic.get('EmailValidator')();
    this._passwordValidator = dic.get('PasswordValidator')();
    this._loginFormSetter = dic.get('LoginFormSetter')();
    this._email = null;
    this._password = null;
}

LoginForm.prototype.sendLoginForm = function() {
    this._loginFormSetter.deleteErrorsClass();
    this._setLoginFormValues();
    this._validate();
    this._ajax.sendJSON(
        'login.form',
        {
            email: this._email,
            password: this._password
        }
    );
};

LoginForm.prototype._validate = function() {
    try {
        this._emailValidator.validate(this._email);
        this._passwordValidator.validate(this._password);
    } catch (Error) {
        console.log(Error);
        if (Error instanceof EmailValidError) {
            this._loginFormSetter.setEmailError();
        } else if (Error instanceof PasswordValidError) {
            this._loginFormSetter.setPasswordError();
        }
    }
};

LoginForm.prototype._setLoginFormValues = function() {
    this._email = $('#loginEmail').prop('value');
    this._password = $('#loginPassword').prop('value');
};
