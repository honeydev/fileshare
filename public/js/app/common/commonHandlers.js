/**
 * Created by honey on 28/10/17.
 */

'use strict';



export {CommonHandlers};

function CommonHandlers(dic) {
    this._dic = dic;
    this._loginForm = dic.get('LoginForm')(dic);
    this._registerForm = dic.get('RegisterForm')(dic);
    console.log('dic', this._dic);
}

CommonHandlers.prototype.setHandlers = function() {
    $('#loginButton').click(() => {
        this._loginForm.sendLoginForm();
    });
    $('#registerButton').click(() => {
        console.log('register button');
        this._registerForm.sendRegisterForm();
    });
};