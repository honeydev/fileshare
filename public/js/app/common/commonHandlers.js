'use strict';

export {CommonHandlers};

function CommonHandlers(dic) {
    this._dic = dic;
    this._loginForm = dic.get('LoginForm')(dic);
    this._loginFormSetter = dic.get('LoginFormSetter')(dic);
    this._registerForm = dic.get('RegisterForm')(dic);
    this._registerFormSetter = dic.get('RegisterFormSetter')();
    this._user = dic.get('User')(dic);
    this._logout = dic.get('Logout')(dic);
    this._profile = dic.get('Profile')(dic);
}

CommonHandlers.prototype.setHandlers = function() {
    $('#loginButton').click(() => {
        this._loginForm.sendLoginForm();
    });
    $('#cancelLoginButton #loginClose').click(() => {
        this._loginFormSetter.deleteErrorsClass();
    });
    $('#registerButton').click(() => {
        this._registerForm.sendRegisterForm();
    });
    $('#registerCancelButton').click(() => {
        //not implemented
    });
    $('#profileA').click(() => {
        //not implemented
    });
    $('#logOutA').click(() => {
        this._logout.logout();
    });
};