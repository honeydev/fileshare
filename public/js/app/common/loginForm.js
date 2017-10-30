/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {LoginForm};

function LoginForm(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._emailValidator = dic.get('EmailValidator')();
    this._passwordValidator = dic.get('PasswordValidator')();
    this._email = null;
    this._password = null;
}

LoginForm.prototype.sendLoginForm = function() {
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
    }
};

LoginForm.prototype._setLoginFormValues = function() {
    this._email = $('#loginEmail').prop('value');
    this._password = $('#loginPassword').prop('value');
};
