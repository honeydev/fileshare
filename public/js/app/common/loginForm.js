/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {LoginForm};

function LoginForm(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._validator = null;
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
    return true;
};

LoginForm.prototype._setLoginFormValues = function() {
    this._email = $('#loginEmail').prop('value');
    this._password = $('#loginPassword').prop('value');
};
