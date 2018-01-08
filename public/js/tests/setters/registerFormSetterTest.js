'use strict';

export {RegisterFormSetterTest};

import {assert} from 'chai';
import {BaseTest} from '../baseTest.js';

function RegisterFormSetterTest(dic) {
    this._registerFormSetter = dic.get('RegisterFormSetter')(dic);
}

RegisterFormSetterTest.prototype = Object.create(BaseTest.prototype);
RegisterFormSetterTest.prototype.constructor = RegisterFormSetterTest;

RegisterFormSetterTest.prototype.test = function () {
    this._setFailedRegStatment();
    this._clearFailedRegStatment();
};

RegisterFormSetterTest.prototype._setFailedRegStatment = function () {
    describe('Set failed authorization statment on login modal window', () => {
        const createDomEnv = this._createDomEnv;
        const context = this;
        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, ['http://'+location.host, '#registerModal', done]);
        });

        after(() => {
            this._removeDomEnv('#registerModal');
        });

        it('Set faield statment', () => this._registerFormSetter.setFailedRegStatment('invalid_registration_data'));
 
        it('Must be error message', () => { 
            const ELEMENT_EXIST = Boolean($('#registerFormAlert').length);
            assert.isTrue(ELEMENT_EXIST);
        });
        it(`Email group wrap has-error has-feedback`, () => {
            assert.isTrue($('#registerEmailGroup').hasClass('has-error'));
            assert.isTrue($('#registerEmailGroup').hasClass('has-feedback'));
        });
        it(`Password group wrap has-error has-feedback`, () => {
            assert.isTrue($('#registerPasswordGroup').hasClass('has-error'));
            assert.isTrue($('#registerPasswordGroup').hasClass('has-feedback'));                
        });
        it(`Repeat password group wrap has-error has-feedback`, () => {
            assert.isTrue($('#regPasswordRepeat').hasClass('has-error'));
            assert.isTrue($('#regPasswordRepeat').hasClass('has-feedback'));                
        });
        it(`Name group wrap has-error has-feedback`, () => {
            assert.isTrue($('#registerNameGroup').hasClass('has-error'));
            assert.isTrue($('#registerNameGroup').hasClass('has-feedback'));                
        });      
    });
};

RegisterFormSetterTest.prototype._clearFailedRegStatment = function () {
    describe('Clear failed registration statment on registration form', () => {
        const context = this;
        const createDomEnv = this._createDomEnv;
        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, [location.host, '#registerModal', done]);
        });
        after(() => {
            this._removeDomEnv();
        });
        it('Set failed statment', () => this._registerFormSetter.setFailedRegStatment('invalid_registration_data'));
        it('Clear failed statment', () => this._registerFormSetter.clearFailedRegStatment());
        it('No error message about invalid data', function () {
            const ELEMENT_EXIST = Boolean($('#registerFormAlert').length);
            assert.isFalse(ELEMENT_EXIST);
        });
        it('No email error class', function () {
            assert.isFalse($('#registerEmailGroup').hasClass('has-error'));
            assert.isFalse($('#registerEmailGroup').hasClass('has-feedback'));
        });
        it('No passwords fields error classes', function () {
            assert.isFalse($('#registerPasswordGroup').hasClass('has-error'));
            assert.isFalse($('#registerPasswordGroup').hasClass('has-feedback'));  
        });
        it('No name error classes', function () {
            assert.isFalse($('#registerNameGroup').hasClass('has-error'));
            assert.isFalse($('#registerNameGroup').hasClass('has-feedback'));        
        });
    });
};
