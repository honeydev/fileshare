'use strict';

export {LoginFormTest};

import {assert} from 'chai';

function LoginFormTest(dic) {
    this._loginForm = dic.get('LoginForm')(dic);
}

LoginFormTest.prototype.test = function () {
    this._sendLoginForm();
};

LoginFormTest.prototype._sendLoginForm = function () {
    describe('Try send login form', () => {
        before((done) => {
            this._createDomEnv(done);

        });
        after(() => {
            this._removeDomEnv();
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

LoginFormTest.prototype._createDomEnv = function (done) {
    const REQUEST = $.get('http://'+location.host, function () {
        const MAIN_PAGE = REQUEST.responseText;
        const LOGIN_FORM = $(MAIN_PAGE).find('#loginModal');
        $('body').append(LOGIN_FORM);
        done();
    });
};

LoginFormTest.prototype._removeDomEnv = function () {
    $('#loginModal').remove();
};