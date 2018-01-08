'use strict';

export {LoginFormTest};

import {assert} from 'chai';
import {BaseTest} from './baseTest';

function LoginFormTest(dic) {
    this._loginForm = dic.get('LoginForm')(dic);
}

LoginFormTest.prototype = Object.create(BaseTest.prototype);
LoginFormTest.prototype.constructor = LoginFormTest;

LoginFormTest.prototype.test = function () {
    this._sendLoginForm();
};

LoginFormTest.prototype._sendLoginForm = function () {
    describe('Try send login form', () => {
        const createDomEnv = this._createDomEnv;
        const context = this;
        console.log('create dom', this._createDomEnv);
        before(function (done) {
            this.timeout(4000);
            console.log('create dom env in before', createDomEnv);
            createDomEnv.apply(context, [location.host, '#loginModal', done]);
        });
        after(() => {
            this._removeDomEnv('#loginModal');
        });
        console.log(beforeEach);
        it('send login form', () => {
            $('#loginEmail').val('devseas@gmail.com');
                console.log($('#loginEmail'), 'log email');
            $('#loginPassword').val('margera');
                this._loginForm.sendLoginForm();
                assert.isTrue(true);

        });
    });
};

