'use strict';

export {ProfileFailedStatmentSetterTest};

import {BaseTest} from '../baseTest.js';
import {assert} from 'chai';

function ProfileFailedStatmentSetterTest(dic) {
    this._profileFailedStatmentSetter = dic.get('ProfileFailedStatmentSetter')(dic);
    this._profileFormSetter = dic.get('ProfileFormSetter')(dic);
}

ProfileFailedStatmentSetterTest.prototype = Object.create(BaseTest.prototype);
ProfileFailedStatmentSetterTest.prototype.constructor = ProfileFailedStatmentSetterTest;

ProfileFailedStatmentSetterTest.prototype.test = function () {
    this._testMethods();
    this._testInterface();
};

ProfileFailedStatmentSetterTest.prototype._testMethods = function () {

};

ProfileFailedStatmentSetterTest.prototype._testInterface = function () {
    describe('Test profileFailedStatmentSetter.setFailedStatment interfaces', () => {
        let context = this;
        before(function (done) {
            this.timeout(4000);
            context._createDomEnv(location.host, '#profileModal', done);
        });

        after(() => {
            this._removeDomEnv('#profileModal');
        });

        it('Switch profile to form', () => this._profileFormSetter.switchToForm({
                email: "testuser@mail.com",
                name: "newusername",
                accessLvl: 1,
                id: 1,
                avatarUri: null
        }));

        it("Set avatar error", () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_avatar');
            assert.isTrue(Boolean($('#profileErrorMessage').length));
            assert.equal($('#profileErrorMessage').text(), 'Invalid avatar image');
        });

        it("Set invalid email error", () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_email');
            assert.equal($('#profileErrorMessage').text(), 'Invalid new email');
            assert.isTrue($('#profileEmailGroup').hasClass("has-error has-feedback"));
        });        

        it("Set invalid name error", () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_name');
            assert.equal($('#profileErrorMessage').text(), 'Invalid new name');
            assert.isTrue($('#profileNameGroup').hasClass("has-error has-feedback"));
        });
        
        it("Set password error", () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_passwords');
            assert.equal($('#profileErrorMessage').text(), 'Invalid password value');
            assert.isTrue($('#profileCurrentPasswordGroup').hasClass("has-error has-feedback"));
            assert.isTrue($('#profileNewPasswordGroup').hasClass("has-error has-feedback"));
            assert.isTrue($('#repeatNewPasswordGroup').hasClass("has-error has-feedback"));
        });

        it("Set password equal error", () => {
            this._profileFailedStatmentSetter.setFailedStatment('passwords_not_equal');
            assert.equal($('#profileErrorMessage').text(), 'Passwords not equal');
            assert.isTrue($('#profileNewPasswordGroup').hasClass("has-error has-feedback"));
            assert.isTrue($('#repeatNewPasswordGroup').hasClass("has-error has-feedback"));
        });
    });

    describe('Test profileFailedStatmentSetter.setFailedStatment interfaces', () => {
        let context = this;
        before(function (done) {
            this.timeout(4000);
            context._createDomEnv(location.host, '#profileModal', done);
        });

        after(() => {
            this._removeDomEnv('#profileModal');
        });

        it('Switch profile to form', () => this._profileFormSetter.switchToForm({
                email: "testuser@mail.com",
                name: "newusername",
                accessLvl: 1,
                id: 1,
                avatarUri: null
        }));

        it('Clear failed statment after invalid avatar', () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_avatar');
            this._profileFailedStatmentSetter.clearFailedStatment();
            assert.isFalse(Boolean($('#profileErrorMessage').length));
        });

        it('Clear failed statment after invalid email', () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_email');
            this._profileFailedStatmentSetter.clearFailedStatment();
            assert.isFalse(Boolean($('#profileErrorMessage').length));
            assert.isFalse($('#profileEmailGroup').hasClass("has-error has-feedback"));
        });

        it('Clear failed statment after invalid name', () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_name');
            this._profileFailedStatmentSetter.clearFailedStatment();
            assert.isFalse(Boolean($('#profileErrorMessage').length));       
            assert.isFalse($('#profileNameGroup').hasClass("has-error has-feedback"));
        });

        it('Clear failed statment after passwords', () => {
            this._profileFailedStatmentSetter.setFailedStatment('invalid_passwords');
            this._profileFailedStatmentSetter.clearFailedStatment();
            assert.isFalse(Boolean($('#profileErrorMessage').length));
            assert.isFalse($('#profileCurrentPasswordGroup').hasClass("has-error has-feedback"));
            assert.isFalse($('#profileNewPasswordGroup').hasClass("has-error has-feedback"));
            assert.isFalse($('#repeatNewPasswordGroup').hasClass("has-error has-feedback"));
        });

        it('Clear failed statment after passwords not equal', () => {
            this._profileFailedStatmentSetter.setFailedStatment('passwords_not_equal');
            this._profileFailedStatmentSetter.clearFailedStatment();
            assert.isFalse(Boolean($('#profileErrorMessage').length));
            assert.isFalse($('#profileNewPasswordGroup').hasClass("has-error has-feedback"));
            assert.isFalse($('#repeatNewPasswordGroup').hasClass("has-error has-feedback"));

        });
    });
};        