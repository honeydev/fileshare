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
    this._testMethods();
    this._testInterface();
};

ProfileDataCollectorTest.prototype._testMethods = function () {
    describe('Test profileDataCollector methods', () => {
        it('Test prepareUserData method', () => {
            const USER_DATA = {
                email: "newEmail@email.com",
                name: "newName",
                currentPassword: "currentPassword",
                newPassword: "newPassword",
                repeatNewPassword: "repeatNewPassword"
            };
            const CHANGED_INPUTS = {
                userData: {
                    'profileEmailInput': $('<input value="newEmail@email.com">'),
                    'profileNameInput': $('<input value="newName">')
                },
                userPasswords: {
                    'profileCurrentPasswordInput': $('<input value="currentPassword">'),
                    'profileNewPasswordInput': $('<input value="newPassword">'),
                    'profileNewPasswordRepeatInput': $('<input value="repeatNewPassword">')
                }
            };
            console.log(this._profileDataCollector._prepareUserData(CHANGED_INPUTS), USER_DATA);
            assert.deepEqual(this._profileDataCollector._prepareUserData(CHANGED_INPUTS), USER_DATA);
        });
    });
};;

ProfileDataCollectorTest.prototype._testInterface = function () {
    describe('Chnage user data in profile', () => {
        let profileDataCollector = this._profileDataCollector;
        let context = this;
        const createDomEnv = this._createDomEnv;

        before(function (done) {
            this.timeout(4000);
            createDomEnv.apply(context, [location.host, '#profileModal', done]);
        });

        after(() => {
            //this._removeDomEnv();
        });

        it('Switch profile to form', () => this._profileFormSetter.switchToForm({
                email: "testuser@mail.com",
                name: "newusername",
                accessLvl: 1,
                id: 1,
                avatarUri: null
        }));

        it('Colect changed user data from from', function () {
            $('#profileCurrentPasswordInput').val('currentPassword');
            $('#profileNewPasswordInput').val('newpassword');
            $('#profileNewPasswordRepeatInput').val('newpassword');
            profileDataCollector.collect({
                email: "testuser@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
            assert.isFalse(Boolean($('#profileForm').length, 'switch to profile'))
            assert.isTrue(Boolean($('#userDataList').length));
        });
    });
};

ProfileDataCollectorTest.prototype._createDomEnv = function (url, elem, done) {
    BaseTest.prototype._createDomEnv.apply(this, arguments);
};
