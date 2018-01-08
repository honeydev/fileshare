'use strict';

export {LoginFormSetterTest};

import {assert} from 'chai';
import {BaseTest} from '../baseTest.js';

function LoginFormSetterTest(dic) {
    this._loginFormSetter = dic.get('LoginFormSetter')(dic);
}

LoginFormSetterTest.prototype = Object.create(BaseTest.prototype);
LoginFormSetterTest.prototype.constructor = LoginFormSetterTest;

LoginFormSetterTest.prototype.test = function () {
    this._failedAuthorizationStatment();
    this._clearAuthorizeFailedStatment();
};

LoginFormSetterTest.prototype._failedAuthorizationStatment = function () {
    describe('Set failed authorization statment on login modal window', () => {
        before((done) => {
            this._createDomEnv('http://'+location.host, '#loginModal', done);
        });
        after(() => {
            this._removeDomEnv('#loginModal');
        });

        it('Set failed', () => this._loginFormSetter.setFailedAuthorizeStatment('invalid_data'));
 
        it('Must be error message', () => { 
            const ELEMENT_EXIST = Boolean($('#loginFormAlert').length);
            assert.isTrue(ELEMENT_EXIST);
        });
        it(`Email group wrap has-error has-feedback`, () => {
            this._loginFormSetter._setEmailError();
            assert.isTrue($('#loginEmailGroup').hasClass('has-error'));
            assert.isTrue($('#loginEmailGroup').hasClass('has-feedback'));
        });
        it(`Password group wrap has-error has-feedback`, () => {
            this._loginFormSetter._setPasswordError();
            assert.isTrue($('#loginPasswordGroup').hasClass('has-error'));
            assert.isTrue($('#loginPasswordGroup').hasClass('has-feedback'));                
        });
    });
};

LoginFormSetterTest.prototype._clearAuthorizeFailedStatment = function () {
    describe('Clear failed authorization statment on login modal window', () => {
        before((done) => {
            this._createDomEnv('http://'+location.host, '#loginModal', done);
        });
        after(() => {
            this._removeDomEnv('#loginModal');
        });
        it('Set authorize failed and clear', ()=> {
            this._loginFormSetter.setFailedAuthorizeStatment('invalid_data');
            this._loginFormSetter.clearAuthorizeFailedStatment();
        });
        it('Drop Error message', () => {
            const ELEMENT_EXIST  = Boolean($('#loginFormAlert').length);
            assert.isFalse(ELEMENT_EXIST);
        });
        it('email group wrap error classes must be droped', () => {
            assert.isFalse($('#loginEmailGroup').hasClass('has-error'));
            assert.isFalse($('#loginEmailGroup').hasClass('has-feedback'));
        });
        it(`Password group wrap error classes must be droped`, () => {
            assert.isFalse($('#loginPasswordGroup').hasClass('has-error'));
            assert.isFalse($('#loginPasswordGroup').hasClass('has-feedback'));                
        });
    });
};
