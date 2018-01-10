'use strict';

export {ProfileUploaderTest};

import {assert} from 'chai';
import {BaseTest} from './baseTest';

function ProfileUploaderTest(dic) {
    this._profileUploader = dic.get('ProfileUploader')(dic);
    this._profile = dic.get('Profile')(dic);
    this._profileFormSetter = dic.get('ProfileFormSetter')(dic);
}

ProfileUploaderTest.prototype = Object.create(BaseTest.prototype);
ProfileUploaderTest.prototype.constructor = ProfileUploaderTest;

ProfileUploaderTest.prototype.test = function () {
    this._testMethods();
    this._testInterface();
};

ProfileUploaderTest.prototype._testMethods = function () {
    describe('Test profileUploader methods', () => {
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
            console.log(this._profileUploader._prepareUserData(CHANGED_INPUTS), USER_DATA);
            assert.deepEqual(this._profileUploader._prepareUserData(CHANGED_INPUTS), USER_DATA);
        });
    });
};;

ProfileUploaderTest.prototype._testInterface = function () {
    describe('Chnage user data in profile', () => {
        let profileUploader = this._profileUploader;
        const context = this;
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

        it('Send coorect changed form', function () {
            $('#profileCurrentPasswordInput').val('currentPassword');
            $('#profileNewPasswordInput').val('newpassword');
            $('#profileNewPasswordRepeatInput').val('newpassword');
            profileUploader.upload({
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

ProfileUploaderTest.prototype._createDomEnv = function (url, elem, done) {
    BaseTest.prototype._createDomEnv.apply(this, arguments);

};
