'use strict';

export {ProfileDataCollectorTest};

import {assert} from 'chai';
import {BaseTest} from './baseTest';

function ProfileDataCollectorTest(dic) {
    this._profileDataCollector = dic.get('ProfileDataCollector')(dic);
    this._profile = dic.get('Profile')(dic);
    this._profileFormSetter = dic.get('ProfileFormSetter')(dic);
}

ProfileDataCollectorTest.prototype = Object.create(BaseTest.prototype);
ProfileDataCollectorTest.prototype.constructor = ProfileDataCollectorTest;

ProfileDataCollectorTest.prototype.test = function () {
    this._testInterfaceWithCorrectInputs();
    this._testInterfaceWithIncorrectInputs();
};

ProfileDataCollectorTest.prototype._testInterfaceWithCorrectInputs = function () {
    describe('Give on input correct values', () => {
        let profileDataCollector = this._profileDataCollector;
        let context = this;
        const createDomEnv = this._createDomEnv;

        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, [location.host, '#profileModal', done]);
        });

        after(() => {
            this._removeDomEnv('#profileModal');
        });

        this._switchProfileToForm();

        it('Colect and return changed user data from from', function () {
            $('#profileEmailInput').val('newTestUserEmail@email.com');
            $('#profileNameInput').val('new name');
            $('#profileCurrentPasswordInput').val('currentPassword');
            $('#profileNewPasswordInput').val('newpassword');
            $('#profileNewPasswordRepeatInput').val('newpassword');
            const COLLECTED_DATA = profileDataCollector.collect({
                email: "testuser@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isObject(COLLECTED_DATA);
            assert.property(COLLECTED_DATA, 'email');
            assert.property(COLLECTED_DATA, 'name');
            assert.property(COLLECTED_DATA, 'currentPassword');
            assert.property(COLLECTED_DATA, 'newPassword');
            assert.property(COLLECTED_DATA, 'repeatNewPassword');
        });

        it('Return null because form not changed', function () {
            $('#profileEmailInput').val(null);
            $('#profileNameInput').val(null);
            $('#profileCurrentPasswordInput').val(null);
            $('#profileNewPasswordInput').val(null);
            $('#profileNewPasswordRepeatInput').val(null);           

            const COLLECTED_DATA = profileDataCollector.collect({
                email: "testuser14@mail.com",
                name: "newusername",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.notExists(COLLECTED_DATA);
        });
    });
};

ProfileDataCollectorTest.prototype._testInterfaceWithIncorrectInputs = function () {
    describe('Give on input incorrect values', () => {
        let profileDataCollector = this._profileDataCollector;
        let context = this;
        const createDomEnv = this._createDomEnv;
        const INCORRECT_SYMBOL = "#";

        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, [location.host, '#profileModal', done]);
        });

        after(() => {
            this._removeDomEnv('#profileModal');
        });

        this._switchProfileToForm();
        it('Showed error about incorrect email', function () {
            $('#profileEmailInput').val('newIncorrectEmail' + INCORRECT_SYMBOL);
            profileDataCollector.collect({
                email: "testuser@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isTrue(Boolean($('#profileErrorMessage').length));
            assert.equal('Invalid new email', $('#profileErrorMessage').text());
            $('#profileEmailInput').val('testuser@mail.com');
            $('#profileErrorMessage').remove();
        });
        it('Showed error about incorrect name', function () {
            $('#profileNameInput').val('incorrect name' + INCORRECT_SYMBOL);
            profileDataCollector.collect({
                email: "testuser14@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isTrue(Boolean($('#profileErrorMessage').length));
            assert.equal('Invalid new name', $('#profileErrorMessage').text());
            $('#profileNameInput').val("username");
            $('#profileErrorMessage').remove();
        });
        it('Showed error about incorrect password', function () {
            $('#profileCurrentPasswordInput').val('incorrectPassword' + INCORRECT_SYMBOL);
            profileDataCollector.collect({
                email: "testuser14@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isTrue(Boolean($('#profileErrorMessage').length));
            assert.equal('Invalid password value', $('#profileErrorMessage').text());   
            $('#profileCurrentPasswordInput').val(null); 
            $('#profileErrorMessage').remove();
        });
        it('Showed error about not equal new passwords', function () {
            $('#profileCurrentPasswordInput').val('password');
            $('#profileNewPasswordInput').val('newPassword');
            $('#profileNewPasswordRepeatInput').val('invalidRepeat');  
            profileDataCollector.collect({
                email: "testuser14@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isTrue(Boolean($('#profileErrorMessage').length));
            assert.equal('Passwords not equal', $('#profileErrorMessage').text());   
            $('#profilePassowrdInput').val(null);
            $('#profileNewPasswordInput').val(null);
            $('#profileNewPasswordRepeatInput').val(null); 
            $('#profileErrorMessage').remove();
        });
    });
};

ProfileDataCollectorTest.prototype._switchProfileToForm = function () {
    it('Switch profile to form', () => this._profileFormSetter.switchToForm({
            email: "testuser@mail.com",
            name: "username",
            accessLvl: 1,
            id: 1,
            avatarUri: null
    }));
};

ProfileDataCollectorTest.prototype._createDomEnv = function (url, elem, done) {
    BaseTest.prototype._createDomEnv.apply(this, arguments);
};

