'use strict';

export {RegisterFormTest};

import {BaseTest} from './BaseTest';

function RegisterFormTest(dic) {
    this._registerForm = dic.get('RegisterForm')(dic);
}

RegisterFormTest.prototype = Object.create(BaseTest.prototype);
RegisterFormTest.prototype.constructor = BaseTest;

RegisterFormTest.prototype.test = function () {
    this._sendRegisterForm();
};

RegisterFormTest.prototype._sendRegisterForm = function () {
    describe(``, () => {
        before((done) => {
            this.prototype._createDomEnv('http://'+location.host, '#registerModal', done);
        });
        it('', () => {

        });
    });
};
