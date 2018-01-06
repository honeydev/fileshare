'use strict';

export {LoginFormSetterTest};

import {assert} from 'chai';
import {loginFormTemplate} from './templates/login_form_template.js';

function LoginFormSetterTest(dic) {
	this._loginFormSetter = dic.get('LoginFormSetter')(dic);
}

LoginFormSetterTest.prototype.test = function () {
    console.log('loginformsetter', this._loginFormSetter);

    this._failedAuthorizationStatment();
    this._clearAuthorizeFailedStatment();
    //this._removeDomEnv();
};

LoginFormSetterTest.prototype._failedAuthorizationStatment = function () {
    describe('Set failed authorization statment on modal window', () => {
        this._createDomEnv();
        this._loginFormSetter.setFailedAuthorizeStatment('invalid_data'); 
        it('Must be error message', () => {
            console.log($('#loginFormAlert').length);
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
    describe('Drop error message, delete error classes', () => {
        this._loginFormSetter.clearAuthorizeFailedStatment();
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
        setTimeout(() => this._removeDomEnv(), 100);
    });
};

LoginFormSetterTest.prototype._checkErrorClass = function () {

}

LoginFormSetterTest.prototype._createDomEnv = function () {
    $('body').append(loginFormTemplate);
};

LoginFormSetterTest.prototype._removeDomEnv = function () {
    $('#loginModal').remove();
};
