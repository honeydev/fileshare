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
        it('', () =>this._profileFormSetter.switchToForm({
                email: "testuser@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null

        }));
        it('Send changed form', function () {
            
            profileUploader.upload({
                email: "testuser@mail.com",
                name: "username",
                accessLvl: 1,
                id: 1,
                avatarUri: null
            });
        });
    });
};

ProfileUploaderTest.prototype._createDomEnv = function (url, elem, done) {
    this.__proto__._createDomEnv.apply(this, arguments);
};
