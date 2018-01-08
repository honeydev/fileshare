'use strict';

export {RegisterFormTest};

import {BaseTest} from './baseTest';

function RegisterFormTest(dic) {
    this._registerForm = dic.get('RegisterForm')(dic);
}

RegisterFormTest.prototype = Object.create(BaseTest.prototype);
RegisterFormTest.prototype.constructor = RegisterFormTest;

RegisterFormTest.prototype.test = function () {
    this._sendRegisterForm();
};

RegisterFormTest.prototype._sendRegisterForm = function () {
    describe(`Send register form`, () => {
        const createDomEnv = this._createDomEnv;
        const context = this;
        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, ['http://'+location.host, '#registerModal', done]);
        });
        after(() => {
            this._removeDomEnv('#registerModal');
        });
        it('Send correct registration form', () => {
            $('#registerEmail').val('test@test.com');
            $('#registerName').val('test user');
            $('#registerPassword').val('password');
            $('#passwordRepeat').val('password');
            this._registerForm.sendRegisterForm();
        });
    });
};
