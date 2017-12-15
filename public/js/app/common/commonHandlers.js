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
    this._user = dic.get('User')(dic);
    this._logout = dic.get('Logout')(dic);
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
    $('#profileA').click(() => {
        console.log('username click');
        this._user.showUser();
    });
    $('#logOutA').click(() => {
        console.log('logout handler');
        this._logout.logout();
    });
};