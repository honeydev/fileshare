/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {CommonHandlers};

function CommonHandlers(dic) {
    this._dic = dic;
    this._loginForm = dic.get('LoginForm')(dic);
    this._loginFormSetter = dic.get('LoginFormSetter')(dic);
    this._registerForm = dic.get('RegisterForm')(dic);
    this._registerFormSetter = dic.get('RegisterFormSetter')();
    console.log('dic', this._dic);
}

CommonHandlers.prototype.setHandlers = function() {
    $('#loginButton').click(() => {
        this._loginForm.sendLoginForm();
    });
    $('#cancelLoginButton #loginClose').click(() => {
        this._loginFormSetter.deleteErrorsClass();
    });
    $('#registerButton').click(() => {
        console.log('register button');
        this._registerForm.sendRegisterForm();
    });
    $('#registerCancelButton').click(() => {
        console.log('register cancel button');
    });
};