/**
 * Created by honey on 29/10/17.
 */

'use strict';

export {RegisterForm};

function RegisterForm(dic) {
    this._ajax = dic.get('Ajax')();
    this._
    this._email = null;
    this._name = null;
    this._password = null;
    this._passwordRepeat = null;
}

RegisterForm.prototype.sendRegisterForm = function() {
    this._setRegisterFormValues();
    this._validate();
    this._ajax.sendJSON(
        'register.form',
        {
            email: this._email,
            name: this._name,
            password: this._password,
            passwordRepeat: this._passwordRepeat
        }
    );
};
RegisterForm.prototype._validate = function() {
    try {

    } catch (Error) {

    }
};

RegisterForm.prototype._setRegisterFormValues = function() {
    this._email = $('#registerEmail').prop('value');
    this._name = $('#registerName').prop('value');
    this._password = $('#registerPassword').prop('value');
    this._passwordRepeat = $('#passwordRepeat').prop('value');
};